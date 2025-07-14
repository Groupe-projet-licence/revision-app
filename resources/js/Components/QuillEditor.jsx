import React, { lazy, Suspense, useRef } from 'react';

const QuillEditor = ({ error, ...props }) => {
    const ReactQuill = lazy(() => import('react-quill'));

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
        <div  className={`masking-quill ${error && 'quill-error'}`}>
            <Suspense fallback={
                <div className='loader'>
                    <div className='spinner-border text-primary' role='status'>
                        <span className="sr-only">Loading the editor...</span>
                    </div>
                </div>}>
                <ReactQuill
                    {...props}
                    modules={modules}
                    formats={formats}
                    theme="snow"
                />
            </Suspense>
        </div>
    );
};

export default React.memo(QuillEditor);