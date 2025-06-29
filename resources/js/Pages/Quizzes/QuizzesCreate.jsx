import QuillEditor from "@/Components/QuillEditor";


import React, { useCallback, useRef, useState } from 'react';
import AuthLayouts from '@/Layouts/AuthLayouts';
import { useForm } from '@inertiajs/react';


function QuizzesIndex () {

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

  const addOption = () => {
    if (data.answers.length < 8) {
      setData('answers', [...data.answers, { answer_text: '', is_correct: false }])
    }
  };

  const removeOption = (index) => {
    if (data.answers.length > 2) {
      // Supprimer la ref
      console.log(answersRefs.current);
      answersRefs.current.splice(index, 1);
      // Supprimer l'option
      const newOptions = data.answers.filter((_, i) => i !== index);
      setData('answers', newOptions);
      console.log(answersRefs.current);
    }
  };

  
  
  const handleSubmit = (e) => {
    e.preventDefault();
    post(route('questions.store'));
  };
  
  // Pour la memorisation du QuillEditor pour le texte de la question
  const questionTextRef = useRef(data.question_text);
  const handleChangeQuestionText = useCallback((value) => {
    setData('question_text', value)
  }, [])
  
  const handleOptions = useCallback((index, value) => {
    const newOptions = [...data.answers];
    newOptions[index]['answer_text'] = value;
    setData('answers', newOptions);
  }, [])
  const handleOptionsText = useCallback((value) => handleOptions(index, value), []);
  
  // Pour la memorisation des QuillEditor pour les options de la question
  const answersRefs = useRef([])

  // Pour la gestion des erreurs sur les QuillEditor pour les options de la question
  const errorRef = useRef('');

  errorRef.current = Object.keys(errors).some((key) => {
    return /^answers\.\d+\.answer_text$/.test(key)
  }) ? 'Erreur' : '';


  return (
    <AuthLayouts>

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

          //const text = useRef(data.answers[index].answer_text);
          if (!answersRefs.current[index]) {
            answersRefs.current[index] = React.createRef();
          }



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
              <div className="small-quill flex-grow-1">
                <QuillEditor
                  value={answersRefs.current[index].answer_text}
                  onChange={handleOptionsText}
                  error={errorRef.current} />
              </div>
              <button
                type="button"
                className="fs-5"
                onClick={() => removeOption(index)}
                disabled={data.answers.length <= 2}
              >
                <div style={{fontSize:'25 px'}}>×</div>
                
              </button>

            </div>
          )
        }
        )}

        <button type="button" onClick={addOption}>Ajouter une option</button>
        <button type="submit" className='btn btn-primary'>Créer la question</button>
      </form>
    </AuthLayouts>
  )

}

export default QuizzesIndex;