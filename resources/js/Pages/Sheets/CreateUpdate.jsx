import React, { useCallback, useRef } from 'react';
import { useForm } from '@inertiajs/react';
import QuillEditor from '../../Components/QuillEditor';

export default function CreateUpdate({ sheet }) {
    const { data, setData, post, put, processing, errors } = useForm({
        title: sheet ? sheet.title : '',
        description: sheet ? sheet.description : '',
        content: sheet ? sheet.content : '',
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        if (sheet) {
            put(route('sheets.update', [sheet]))
        } else {
            post(route('sheets.store'))
        }
    };

    const valueQuillRef=useRef(data.content)
    const handleChange= useCallback((value)=>setData('content',value),[])
    return (
        <div className='container mt-3'>
            <form onSubmit={handleSubmit} className='vstack gap-3'>
                <div className="form-group">
                    <input
                        type='text'
                        style={{ boxShadow: 'none'}}
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
                        style={{ boxShadow: 'none'}}
                        placeholder='Description'
                        className={errors.description ? 'is-invalid form-control rounded-2' : 'form-control rounded-2'}
                        value={data.description}
                        onChange={(e) => setData('description', e.target.value)} />
                    {errors.description && <span className="text-danger">{errors.description}</span>}
                </div>
                <QuillEditor value={valueQuillRef.current} onChange={handleChange} error={errors.content}/>
                <div className='text-center'>
                    <button type="submit"
                        className='btn btn-primary'
                        disabled={processing}>
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    );
}
