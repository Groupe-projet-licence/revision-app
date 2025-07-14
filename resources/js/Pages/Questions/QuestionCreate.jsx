import QuillEditor from "@/Components/QuillEditor";


import React, { useCallback, useMemo, useRef, useState } from 'react';
import AuthLayouts from '@/Layouts/AuthLayouts';
import { Head, useForm } from '@inertiajs/react';
import QuillEditorSmall from "@/Components/QuillEditorSmall";


export default function QuestionCreate({ quiz_id }) {

  // Pour la gestion des etats et l'envoie des donnees cote backend
  const { data, setData, post, processing, errors } = useForm({
    question_text: '',
    type: 'single',
    answers: [{ answer_text: '', is_correct: false }, { answer_text: '', is_correct: false }]
  })

  const handleOptionChange = (index, field, value) => {
    const newOptions = [...data.answers];
    newOptions[index][field] = value;
    setData('answers', newOptions);
  };


  const handleSubmit = (e) => {
    e.preventDefault();

    post(route('questions.store', quiz_id));
  };


  // Pour la memorisation du QuillEditor pour le texte de la question
  const questionTextRef = useRef(data.question_text);
  const handleChangeQuestionText = useCallback((value) => {
    setData('question_text', value)
  }, [])


  // Pour la memorisation des QuillEditor pour les options de la question
  const answersRefs = useRef(data.answers)

  const addOption = () => {
    if (data.answers.length < 8) {
      const newOptions = [...data.answers, { answer_text: '', is_correct: false }];
      answersRefs.current = newOptions;
      setData('answers', newOptions);
    }
  };

  const removeOption = (index) => {
    if (data.answers.length > 2) {
      const newOptions = data.answers.filter((_, i) => i !== index);
      answersRefs.current = newOptions;
      setData('answers', newOptions);
    }
  };


  // Pour la gestion des erreurs sur les QuillEditor pour les options de la question
  const errorRef = useRef('');
  errorRef.current = Object.keys(errors).some((key) => {
    return /^answers\.\d+\.answer_text$/.test(key)
  }) ? 'Erreur' : '';



  return (
    <AuthLayouts>
      <Head title='Question' />

      <form onSubmit={handleSubmit}>

        <div className="big-quill big-loader">
          <QuillEditor
            value={questionTextRef.current}
            onChange={handleChangeQuestionText}
            error={errors.question_text}
          />
        </div>

        <div className="form-check form-switch">
          <input type='checkbox' className="form-check-input"
            checked={data.type === "multiple"} onChange={(e) => setData('type', e.target.checked ? "multiple" : "single")} />
        </div>

        {data.answers.map((option, index) => {


          return (
            <div key={index} className="form-group hstack gap-3 mb-3" >
              {data.type === 'single' ? (

                <input
                  type="radio"
                  name="correct"
                  checked={option.is_correct}
                  onChange={() => {
                    const newOptions = data.answers.map((opt, i) => ({
                      ...opt,
                      is_correct: i === index
                    }));
                    setData('answers', newOptions);
                  }}
                />

              ) : (
                <input
                  type="checkbox"
                  checked={option.is_correct}
                  onChange={(e) =>
                    handleOptionChange(index, 'is_correct', e.target.checked)
                  }
                />
              )}
              <div className="small-quill flex-grow-1 hide-quill">
                <QuillEditorSmall
                  index={index}
                  setData={setData}
                  text={answersRefs.current}
                  error={errorRef.current}
                  placeholder="Solution option text"

                />
              </div>
              <button
                type="button"
                className="fs-5 "
                onClick={() => removeOption(index)}
                disabled={data.answers.length <= 2}
              >
                <div style={{ fontSize: '28px' }}>×</div>

              </button>

            </div>
          )
        }
        )}
        <div className="d-flex justify-content-between align-items-center ">
          <button type="button" className="btn text-primary" onClick={addOption} >
            <span className="" style={{ fontSize: '25px' }}>+</span> Add options
          </button>
          <button type="submit" className='btn btn-primary'>Create</button>
        </div>
      </form>
    </AuthLayouts>
  )

}

