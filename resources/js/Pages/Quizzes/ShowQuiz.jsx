/**
 * @param [id:integer, 
 * title:string, 
 * description:string,
 * user_id:integer,
 * created_at: date,
 * updated_at:date,
 * 
 * ]
 */

import AuthLayouts from "@/Layouts/AuthLayouts";
import React from "react";

const ShowQuiz = ({ quiz }) => {
  return (
    <AuthLayouts>
      <div className="container">
        <div className="text-end">
          <button className="btn btn-primary mb-4" href={route('questions.create')} >
            <span className="fs-5">+</span> New question
          </button>
        </div>

      </div>
    </AuthLayouts>
  );
};

export default ShowQuiz;
