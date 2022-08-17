@extends('layout.before-login')
@section('content')
    <div class="container my-4">
        <div class="row">
            <div class="col-md-12 col-12">
                <input placeholder="Search ...." id="autoComplete" class="form-control col-12">
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
            var value = document.getElementById("autoComplete").value;
            loadDataList(value);
        };

        async function changeList() {
            let inputValue = document.getElementById('autoComplete').value;
            console.log('inputValue', inputValue);
            loadDataList(inputValue);
        }

        async function loadDataList(inputValue = '') {
            let params = new URLSearchParams({
                search: inputValue,
                per_page: 290,
                surat_id: `{{ $id }}`
            });

            spinner.style.display = 'block';
            let data = await fetch(`{{ route('api.ayat.index') }}?${params}`)
                .then((response) => response.json())
                .then((res) => {
                    prosesList(res.data);
                    return res.data.map(v => {
                        return {
                            label: v.text_translate,
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
            data.forEach((element, i) => {
                html = `${html}
                <div class="animate__animated animate__fadeInLeft col-md-12 col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3 col-md-1 align-self-center text-center">
                                    <label>${element.surat.order}:${i + 1}</label>
                                    <audio class="audio">
                                        <source src="${element.audio.file_url}" type="audio/mpeg">
                                    </audio>
                                    <div class="btn-audio text-center">
                                        <i class="bi bi-play fs-2 border border-3" width=20 height="20"></i>
                                    </div>
                                </div>

                                <div class="col-9 col-md-10">
                                    <div class="row d-flex justify-content-between">
                                        <div class="align-self-center">
                                            <div class="text-end"><label class="fs-2 text-arab mb-3">${element.text}</label></div>
                                            <div class="text-end"><label class="fs-6">${element.text_translate}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion" id="accordionPanels${i + 1}">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading${i + 1}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${i + 1}" aria-expanded="false" aria-controls="collapse${i + 1}">
                                    Tafsir
                                </button>
                                </h2>
                                <div id="collapse${i + 1}" class="accordion-collapse collapse" aria-labelledby="heading${i + 1}" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="mb-3">
                                        <label class="fs-3">Tafsir Wajiz </label>
                                    </div>
                                    ${element.tafsir.tafsir_wajiz}
                                    <hr>
                                    <div class="mb-3">
                                        <label class="fs-3">Tafsir Tahlili </label>
                                    </div>
                                    ${element.tafsir.tafsir_tahlili}
                                </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>`;
            });
            document.getElementById('list-surat').innerHTML = html;
            let divs = document.querySelectorAll('.btn-audio');
            divs.forEach((element, index) => {
                element.addEventListener('click', function(){
                    let audio =  document.querySelectorAll('.audio');
                    audio[index].play();
                });
            });
            spinner.style.display = 'none';
        }

        function moveDetail(id, slug) {
            location.href = `{{ route('home') }}/${id}/${slug}`;
        }
        </script>
@endsection
