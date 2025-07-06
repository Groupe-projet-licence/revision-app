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

import AuthLayouts from "@/Layouts/AuthLayouts";
import { Head, Link } from "@inertiajs/react";
import React from "react";

const ShowQuiz = ({ quiz }) => {
  console.log(quiz)
  return (
    <AuthLayouts>
      <Head>
        <title>Visualized</title>
      </Head>
      <div className="container">
        <div className="text-end">
          <Link className="btn btn-primary mb-4" href={route('questions.create')} >
            <span className="fs-5">+</span> New question 
          </Link>
        </div>

      </div>
    </AuthLayouts>
  );
};

export default ShowQuiz;
