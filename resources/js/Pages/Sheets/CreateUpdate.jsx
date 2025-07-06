import React, { useCallback, useEffect, useMemo, useRef, useState } from 'react';
import { Head, useForm } from '@inertiajs/react';
import QuillEditor from '../../Components/QuillEditor';
import AuthLayout from '@/Layouts/AuthLayouts';

export default function CreateUpdate({ sheet, categories }) {
    const { data, setData, post, put, processing, errors } = useForm({
        title: sheet ? sheet.title : '',
        description: sheet ? sheet.description : '',
        content: sheet ? sheet.content : '',
        //modifier
        category_id: sheet ? sheet.category_id : '',
    });
    const [FlashMsg, setFlashMsg] = useState('')
    const nbCharacterRemainig = useRef(2000)
    const LongParagraph = useRef(false)


    const handleSubmit = (e) => {
        e.preventDefault();
        if (sheet) {
            put(route('sheets.update', [sheet]))
        } else {
            post(route('sheets.store'))
        }
    };


    const valueQuillRef = useRef(data.content)

    const handleChange = useCallback((value) => {
        setData('content', value)

        nbCharacterRemainig.current = 2000 - countCharacater(value).length

        if (LongParagraph.current = hasLongParagraph(value)) {
            setFlashMsg('Please reduce your paragraphs!!')
        } else {
            setFlashMsg('')
        }

    }, [])

    const countCharacater = (text) => {
        const finalText = text.replace(/<[^>]*>/g, '')
        return finalText.replace(/\s/g, '')
    }

    const countWords = (text) => {
        return text.trim().split(/\s+/).length;
    };

    const hasLongParagraph = (text) => {
        const paragraphs = text.replace(/<(?!br)[^>]*>/g, '').split(/<br>/);
        return paragraphs.some(p => countWords(p) > 100);
    };

    return (<AuthLayout>
        <Head>
            <title>Create Sheet</title>
        </Head>
        <div>
            <form onSubmit={handleSubmit} className='vstack gap-3'>
                {FlashMsg && <div className="alert alert-danger">{FlashMsg}</div>}
                <div className="form-group">
                    <input
                        type='text'
                        style={{ boxShadow: 'none' }}
                        placeholder='Titre'
                        className={errors.title ? 'is-invalid form-control rounded-2' : 'form-control rounded-2'}
                        value={data.title}
                        onChange={(e) => setData('title', e.target.value)} />
                    {errors.title && <span className="text-danger">
                        {errors.title}
                    </span>}
                </div>
                <div className="form-group">
                    <input type='text'
                        style={{ boxShadow: 'none' }}
                        placeholder='Description'
                        className={errors.description ? 'is-invalid form-control rounded-2' : 'form-control rounded-2'}
                        value={data.description}
                        onChange={(e) => setData('description', e.target.value)} />
                    {errors.description && <span className="text-danger">{errors.description}</span>}
                </div>
                <div className="form-group">
                    <select value={data.category_id} onChange={(e) => setData('category_id', e.target.value)} className={errors.category_id ? 'is-invalid form-select rounded-2' : 'form-select rounded-2'}>
                        <option value="">Choisir une categorie</option>
                        {categories.map((cat) => (
                            <option key={cat.id} value={cat.id}>{cat.subject} - Niveau {cat.level}</option>
                        ))}
                    </select>
                    {errors.category_id && <span className="text-danger">{errors.category_id}</span>}
                </div>
                <div className="big-quill big-loader">
                    <QuillEditor value={valueQuillRef.current} onChange={handleChange} error={errors.content} />
                </div>
                <div className='text-center'>
                    <button type="submit"
                        className='btn btn-primary'
                        disabled={processing || nbCharacterRemainig.current < 0 || LongParagraph.current}>
                        {nbCharacterRemainig.current} | Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </AuthLayout>
    );
}
