import React, { lazy, Suspense, useCallback, useRef } from 'react';

const QuillEditorSmall = ({ error, index, setData, text }) => {
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

    const editorRef = useRef(null);
    const handleFocus = () => {
        editorRef.current.classList.add('focused');
    };
    const handleBlur = () => {
        editorRef.current.classList.remove('focused');
    };
    


    console.log(text);
    const onChange = (value) => {
        const newOptions = [...text];
        newOptions[index]['answer_text'] = value;
        setData('answers', newOptions);
    };
    console.log(text);



    return (
        <div ref={editorRef} className={`masking-quill ${error && 'quill-error'}`}>
            <Suspense fallback={
                <div className='loader'>
                    <div className='spinner-border text-primary' role='status'>
                        <span className="sr-only">Chargement de l'editeur...</span>
                    </div>
                </div>}>
                <ReactQuill
                    value={text[index].answer_text}
                    onChange={onChange}
                    modules={modules}
                    formats={formats}
                    onFocus={handleFocus}
                    onBlur={handleBlur}
                    theme="snow"
                />
            </Suspense>
        </div>
    );
};

export default React.memo(QuillEditorSmall);
