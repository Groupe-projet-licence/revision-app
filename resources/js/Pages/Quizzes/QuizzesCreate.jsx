import QuillEditor from "@/Components/QuillEditor";
import AuthLayouts from "@/Layouts/AuthLayouts1";


import { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import QuillEditor from '@/Components/QuillEditor'; // Votre composant personnalisé
import AuthLayouts from '@/Layouts/AuthLayouts';
import { useForm } from '@inertiajs/react';


function QuizzesIndex() {

  const { data, setData, post, processing, errors } = useForm({
    question_text: '',
    type: true,
    answers: []
  })
  const [question, setQuestion] = useState('');
  const [type, setType] = useState('single'); // ou 'multiple'
  const [options, setOptions] = useState([
    { text: '', is_correct: false }
  ]);

  const addOption = () => {
    setOptions([...options, { text: '', is_correct: false }]);
  };

  const handleOptionChange = (index, field, value) => {
    const newOptions = [...options];
    newOptions[index][field] = value;
    setOptions(newOptions);
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    console.log('EXECUTER 1');
    
    setData('question_text',question)
    setData('type',type )
    setData('answers',options)
    
    post('/questions');
    console.log('EXECUTER 2');
  };

  return (
    <AuthLayouts>

      <form onSubmit={handleSubmit}>
        <input
          type="text"
          value={question}
          onChange={(e) => setQuestion(e.target.value)}
          placeholder="Texte de la question"
        />

        <select value={type} onChange={(e) => setType(e.target.value)}>
          <option value="single">Question à réponse unique</option>
          <option value="multiple">Question à réponses multiples</option>
        </select>

        {options.map((option, index) => (
          <div key={index}>
            <input
              type="text"
              value={option.text}
              onChange={(e) => handleOptionChange(index, 'text', e.target.value)}
              placeholder={`Option ${index + 1}`}
            />
            {type === 'single' ? (
              <input
                type="radio"
                name="correct"
                checked={option.is_correct}
                onChange={() => {
                  const newOptions = options.map((opt, i) => ({
                    ...opt,
                    is_correct: i === index
                  }));
                  setOptions(newOptions);
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
          </div>
        ))}

        <button type="button" onClick={addOption}>Ajouter une option</button>
        <button type="submit" className='btn btn-primary'>Créer la question</button>
      </form>
    </AuthLayouts>
  )

}

export default QuizzesIndex;