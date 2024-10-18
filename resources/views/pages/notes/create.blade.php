@extends('mylayouts.app')

@section('titre')
Notes
@endsection

@section('main')
<section class="section_page12">

    <div class="p-3 mb-3">
        <div class="d-flex justify-content-around mb-3">
            <div>
                <h1>Ajouter une note</h1>
            </div>
            <div class="add_btn">
                <a href="{{ route('notes.create') }}" class="">Ajouter une note</a>
            </div>

        </div>
        <div class="container p-3">
            <form action="{{ route('notes.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Titre</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="content">Contenu</label>
                    <div id="quill-editor" class="mb-3" style="height: 300px;">
                    </div>
                    <textarea rows="3" class="mb-3 d-none" name="contenu" id="quill-editor-area"></textarea>
                </div>
                <button type="submit" class="btn float-end" style="background-color: #0C97B5; color:white;">Enregistrer</button>

            </form>
        </div>
    </div>
</section>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('quill-editor-area')) {
            var editor = new Quill('#quill-editor', {
                theme: 'snow'
            });
            var quillEditor = document.getElementById('quill-editor-area');
            editor.on('text-change', function() {
                quillEditor.value = editor.root.innerHTML;
            });

            quillEditor.addEventListener('input', function() {
                editor.root.innerHTML = quillEditor.value;
            });
        }
    });
</script>
@endsection
