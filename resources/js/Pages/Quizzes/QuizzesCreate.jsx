import QuillEditor from "@/Components/QuillEditor";


import { useCallback, useRef, useState } from 'react';
import AuthLayouts from '@/Layouts/AuthLayouts';
import { useForm } from '@inertiajs/react';


function QuizzesIndex() {

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
    setData('answers', [...data.answers, { answer_text: '', is_correct: false }])
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

  // Pour la gestion des erreurs sur les QuillEditor pour les options de la question
  const errorRef = useRef('');

  errorRef.current = Object.keys(errors).some((key) => {
    return /^answers\.\d+\.answer_text$/.test(key)
  }) ? 'Erreur' : '';
  console.log('errorRef.current ' + errorRef.current);


  return (
    <AuthLayouts>

      <form onSubmit={handleSubmit}>

        <div className="big-quill big-loader">

          <QuillEditor
            value={questionTextRef.current}
            onChange={handleChangeQuestionText}
            error={errors.question_text} />
        </div>

        <div className="form-check form-switch">
          <input type='checkbox' className="form-check-input"
            checked={data.type === "multiple"} onChange={(e) => setData('type', e.target.checked ? "multiple" : "single")} />
        </div>

        {data.answers.map((option, index) => {

          const text = useRef(data.answers[index].answer_text);
          const handleOptions = useCallback((value) => {
            const newOptions = [...data.answers];
            newOptions[index]['answer_text'] = value;
            setData('answers', newOptions);
          }, [])

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
                  value={text.current}
                  onChange={handleOptions}
                  error={errorRef.current} />
              </div>

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