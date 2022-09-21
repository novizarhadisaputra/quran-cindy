@extends('layout.before-login')

@section('content')
<div class="container my-3">
    <div class="row my-3">
        <div class="fs-6 col-md-4 col-12 align-self-center bg-success text-center text-white">
            Puasa Yaumul Bidh
        </div>
        <div class="fs-6 col-md-4 col-12 align-self-center bg-info text-center text-white">
            Puasa Senin Kamis
        </div>
        <div class="fs-6 col-md-4 col-12 align-self-center bg-danger text-center text-white">
            Ahad
        </div>
    </div>
    <div class="row my-3">
        <div class="fs-6 col-md-1 col-3 align-self-center">
            Location
        </div>
        <div class="fs-6 col-md-10 col-9 align-self-center" id="location">

        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="table-responsive" id="list-adzan">
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    let listAdzan = document.getElementById('list-adzan');

    async function getLocation() {
        if (navigator.geolocation) {
            await navigator.geolocation.getCurrentPosition(loadDataList, showError);
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }

    function showError(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                alert("User denied the request for Geolocation.");
                break;
            case error.POSITION_UNAVAILABLE:
                alert("Location information is unavailable.");
                break;
            case error.TIMEOUT:
                alert("The request to get user location timed out.");
                break;
            case error.UNKNOWN_ERROR:
                alert("An unknown error occurred.");
                break;
        }
    }

    getLocation();

    async function loadDataList(position) {
        let latitude = position.coords.latitude;
        let longitude = position.coords.longitude;
        let urlGeolocation =
            `https://maps.googleapis.com/maps/api/geocode/json?latlng=${latitude},${longitude}&key={{ env('MAP_API_KEY') }}`;
        let dataGeolocation = await fetch(urlGeolocation)
            .then((response) => response.json())
            .then((res) => {
                let address = '';
                if (res.plus_code) {
                    let resAddress = res.plus_code.compound_code.toString();
                    let split = resAddress.split(' ');
                    address = resAddress.replace(split[0], '');
                }
                return address;
            })
            .catch((err) => {
                alert(err);
            });
        document.getElementById('location').innerText = dataGeolocation;

        let date = new Date();
        let month = parseInt(date.getMonth()) + 1;
        let year = date.getFullYear();

        let params = new URLSearchParams({
            latitude,
            longitude,
            month,
            year
        });
        spinner.style.display = 'block';
        let data = await fetch(`{{ route('api.adzan.index') }}?${params}`)
            .then((response) => response.json())
            .then((res) => {
                prosesList(res.data);
                return res.data.map(v => {
                    return {
                        label: v.name,
                        value: v.id
                    }
                });
            })
            .catch((err) => {
                alert(err);
            });
    }

    function prosesList(data) {
        let html = `<table class="table table-bordered text-nowrap">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Fajr</th>
                        <th>Sunrise</th>
                        <th>Dhuhr</th>
                        <th>Asr</th>
                        <th>Sunset</th>
                        <th>Maghrib</th>
                        <th>Isha</th>
                        <th>Imsak</th>
                        <th>Midnight</th>
                        <th>Firstthird</th>
                        <th>Lastthird</th>
                    </tr>
                </thead>
                `;
        data.forEach((element, index) => {
            let thClass = '';
            if (element.date.hijriah.day == 13 || element.date.hijriah.day == 14 || element.date.hijriah.day ==
                15) {
                thClass = 'table-success';
            } else if (element.date.masehi.weekday.en == 'Monday' || element.date.masehi.weekday.en ==
                'Thursday') {
                thClass = 'table-info';
            } else if (element.date.hijriah.weekday.en == 'Al Ahad') {
                thClass = 'table-danger';
            }
            html = `${html}
                <tbody>
                    <tr class="${thClass}">
                        <td>${element.date.masehi.date} / ${element.date.hijriah.date}H</td>
                        <td>${element.timings.Fajr}</td>
                        <td>${element.timings.Sunrise}</td>
                        <td>${element.timings.Dhuhr}</td>
                        <td>${element.timings.Asr}</td>
                        <td>${element.timings.Sunset}</td>
                        <td>${element.timings.Maghrib}</td>
                        <td>${element.timings.Isha}</td>
                        <td>${element.timings.Imsak}</td>
                        <td>${element.timings.Midnight}</td>
                        <td>${element.timings.Firstthird}</td>
                        <td>${element.timings.Lastthird}</td>
                    </tr>
                </tbody>`;
        });
        html += `</table>`;
        spinner.style.display = 'none';
        listAdzan.innerHTML = html;
    };
</script>
@endsection
