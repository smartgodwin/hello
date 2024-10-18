@extends('mylayouts.app')

@section('titre')
Notes
@endsection

@section('main')
<section class="section_page12">

    <div class="p-3 mb-3">
        <div class="d-flex justify-content-around mb-3">
            <div class="ad_btn">
                <a href="{{ route('notes.index') }}" class=""><i class="fa-solid fa-arrow-left me-4"></i>Retour</a>
            </div>
            <div>
                <h1>Note: {{$note->title}}</h1>
            </div>

        </div>
        <div class="container p-3">
            <form action="{{ route('notes.update', $note->uuid) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Titre</label>
                    <input type="text" name="title" value="{{ $note->title }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="content">Contenu</label>
                    <div id="quill-editor" class="mb-3" style="height: 300px;">
                    </div>
                    <textarea rows="3" class="mb-3 d-none" name="contenu" id="quill-editor-area"></textarea>
                </div>
                <button type="submit" class="btn float-end" style="background-color: #0C97B5; color:white;">Enregister</button>
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
                theme: 'snow',
            });
            var quillEditor = document.getElementById('quill-editor-area');
            var noteContent = `{!! $note->contenu !!}`;
            editor.root.innerHTML = noteContent;
            editor.on('text-change', function() {
                quillEditor.value = editor.root.innerHTML;
            });
        }
    });
</script>
@endsection
