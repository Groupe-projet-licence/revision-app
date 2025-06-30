import AuthLayouts from "@/Layouts/AuthLayouts1";
import React from "react";

const QuestionsIndex = ({ questions }) => {
  return (
    <AuthLayouts>
      <div className="container">
        <div className="text-end">
          <button className="btn btn-primary mb-4"  href="/" >
            <span className="fs-5">+</span> New question
          </button>
        </div>
        
      </div>
    </AuthLayouts>
  );
};

export default QuestionsIndex;
