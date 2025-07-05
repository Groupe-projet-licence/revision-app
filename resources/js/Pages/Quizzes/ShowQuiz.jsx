/**
 * @param [
 *        id:integer, 
 *        title:string, 
 *        description:string,
 *        user_id:integer,
 *        created_at: date,
 *        updated_at:date,
 *        questions:[
 *                 id:integer,
 *                 question_text: string, 
 *                 type: enum('single','multiple'), 
 *                 quiz_id: integer, 
 *                 created_at: date
 *                 updated_at:  date,
 *                 answers:[
 *                        id: integer, 
 *                        answer_text: string, 
 *                        is_correct: 0|1, 
 *                        question_id: integer, 
 *                        created_at:date,
 *                        updated_at:  date
 *                 ]         
 *        ]
 * ] quiz
 */

import { Head } from "@inertiajs/react";
import React, { useState } from 'react';
import { Link, router } from '@inertiajs/react';
import AuthLayouts from '@/Layouts/AuthLayouts';
import ShowContentQuill from '@/Components/ShowContentQuill';

const Evaluate = ({ quiz }) => {
  const [answers, setAnswers] = useState({});

  const handleOptionChange = (questionId, answerId, type) => {
    setAnswers((prev) => {
      const current = prev[questionId] || [];
      if (type === 'single') {
        return { ...prev, [questionId]: [answerId] };
      } else {
        if (current.includes(answerId)) {
          return {
            ...prev,
            [questionId]: current.filter((id) => id !== answerId),
          };
        } else {
          return {
            ...prev,
            [questionId]: [...current, answerId],
          };
        }
      }
    });
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    router.post(route('quiz.submit', quiz.id), {
      quiz_id: quiz.id,
      answers,
    });
  };
  console.log(quiz.id);


  return (
    <AuthLayouts>
      <Head>
        <title>Quiz</title>
      </Head>

      <div >
        <div className="d-flex justify-content-between align-items-center">
          <h1 className="text-2xl font-bold mb-6">{quiz.title}</h1>
          <Link className="btn btn-primary mb-4" href={route('questions.create', quiz.id)} >
            <span className="fs-5">+</span> New question
          </Link>
        </div>
        <form >
          {quiz.questions.map((question, index) => (
            <div key={question.id} className="mb-6">
              <ShowContentQuill className="font-semibold mb-2">{index + 1}. {question.question_text}</ShowContentQuill>

              {question.answers.map((ans) => (
                <label key={ans.id} className="block ml-4">
                  <input type={question.type === 'single' ? 'radio' : 'checkbox'}
                    value={ans.id} checked={ans.is_correct}
                    onChange={() =>
                      handleOptionChange(question.id, ans.id, question.type)}
                  />
                  <ShowContentQuill>
                    {ans.answer_text}
                  </ShowContentQuill>
                </label>
              ))}
            </div>
          ))}
        </form>
      </div>
    </AuthLayouts>
  );
};

export default Evaluate;

