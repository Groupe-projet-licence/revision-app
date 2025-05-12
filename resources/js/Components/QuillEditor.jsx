import React, { lazy, Suspense } from 'react';

const QuillEditor = ({ error, ...props }) => {
    const ReactQuill = lazy(() => import('react-quill'));
    console.log('render Quill')

    const modules = { // Définition des options de la barre d'outils
        toolbar: [
            ['bold', 'italic', 'underline', 'strike'],
            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
            ['blockquote', 'code-block'],
            [{ 'script': 'sub' }, { 'script': 'super' }],
            [{ 'indent': '-1' }, { 'indent': '+1' }],
            [{ 'size': ['small', false, 'large', 'huge'] }],
            [{ 'header': [1, 2, 3, false] }],
            [{ 'color': [] }],
            [{ 'align': [] }],
            ['image'],
            ['clean']
        ]
    };

    const formats = [ // Formats supportés (doit correspondre aux options de la toolbar)
        'header', 'font', 'size', 'script',
        'bold', 'italic', 'underline', 'strike', 'blockquote',
        'list', 'bullet', 'indent',
        'link', 'image', 'color', 'code-block', 'align'
    ];

    return (
        <div>
            <Suspense fallback={
                <div className='d-flex justify-content-center align-items-center'
                    style={{ height: '300px' }}>
                    <div className='spinner-border text-primary' role='status'>
                        <span className="sr-only">Chargement de l'editeur...</span>
                    </div>
                </div>}>
                <ReactQuill
                    {...props}
                    modules={modules}
                    formats={formats}
                    theme="snow"
                />
                {error && <div className="text-danger">{error}</div>}
            </Suspense>
        </div>
    );
};

export default React.memo(QuillEditor);
