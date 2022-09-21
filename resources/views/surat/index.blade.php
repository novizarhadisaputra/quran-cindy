@extends('layout.before-login')

@section('content')
    <div class="container py-4 mb-3">
        <div class="row d-flex">
            <div class="col-12">
                <input placeholder="Search ...." id="autoComplete" class="form-control">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row d-flex justify-content-between" id="list-surat">
        </div>
    </div>
@endsection

@section('scripts')
    <script type="module">
        import { Autocomplete } from "{{ asset('js/autocomplete.js') }}";

        let field = document.getElementById('autoComplete');
        const ac = new Autocomplete(field, {
            data: [],
            maximumItems: 5,
            onSelectItem: ({
                label,
                value
            }) => {
                loadDataList(label);
            }
        });
        ac.setData({
            label: 'No data',
            id: null
        });

        loadDataList();

        document.getElementById("autoComplete").onkeyup = function() {
            let value = document.getElementById("autoComplete").value;
            if (value == ''){
                loadDataList(value);
            }
        };

        async function loadDataList(inputValue = '') {
            let params = new URLSearchParams({
                search: inputValue,
                per_page: 290
            });

            spinner.style.display = 'block';
            let data = await fetch(`{{ route('api.surat.index') }}?${params}`)
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
            ac.setData(data);
        }

        function prosesList(data) {
            let html = '';
            data.forEach((element, index) => {
                html = `${html}
                <div class="animate__animated animate__fadeInLeft col-12 col-md-6 col-lg-6 col-xl-4 mb-3 card-surat" slug=${element.slug}>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3 col-md-2 align-self-center text-start">
                                    <label>${element.order}</label>
                                </div>
                                <div class="col-9 col-md-10">
                                    <div class="row d-flex justify-content-between">
                                        <div class="col text-start align-self-center text-start">
                                            <label>${element.name}  </label>
                                        </div>
                                        <div class="col align-self-center">
                                            <div class="text-end"><label class="fs-1 text-arab lh-lg mb-2">${element.text}</label></div>
                                            <div class="text-end"><label class="fs-6">${element.count_ayat} Ayat</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
            });
            document.getElementById('list-surat').innerHTML = html;
            let divs = document.querySelectorAll('.card-surat');
            divs.forEach((element, index) => {
                element.addEventListener('click', function(){
                    let slug = element.getAttribute('slug');
                    location.href = `{{ route('surat') }}/${slug}`;
                });
            });
            spinner.style.display = 'none';
        }
    </script>
@endsection
