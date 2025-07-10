import { Head, Link, router } from "@inertiajs/react";
import React, { useState, useEffect, useRef } from "react";
import AuthLayouts from "@/Layouts/AuthLayouts";
import ShowContentQuill from "@/Components/ShowContentQuill";

const Evaluate = ({ quiz }) => {
  const [answers, setAnswers] = useState({});
  const [openDropdown, setOpenDropdown] = useState(null);
  const dropdownRefs = useRef({});

  useEffect(() => {
    const handleClickOutside = (e) => {
      if (openDropdown && !dropdownRefs.current[openDropdown]?.contains(e.target)) {
        setOpenDropdown(null);
      }
    };
    document.addEventListener("mousedown", handleClickOutside);
    return () => document.removeEventListener("mousedown", handleClickOutside);
  }, [openDropdown]);

  const toggleDropdown = (questionId) => {
    setOpenDropdown((prev) => (prev === questionId ? null : questionId));
  };

  const handleDelete = (questionId) => {
    if (confirm("Supprimer cette question ?")) {
      router.delete(route("questions.destroy", questionId));
    }
  };

  const handleOptionChange = (questionId, answerId, type) => {
    setAnswers((prev) => {
      const current = prev[questionId] || [];
      if (type === "single") {
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
    router.post(route("quiz.submit", quiz.id), { answers });
  };

  return (
    <AuthLayouts>
      <Head title="Quiz" />

      <div className="mb-6">
        <div className="d-flex justify-content-between align-items-center">
          <h1 className="text-2xl font-bold">{quiz.title}</h1>
          <Link
            className="btn btn-primary"
            href={route("questions.create", quiz.id)}
          >
            <span className="fs-5">+</span> New question
          </Link>
        </div>
      </div>

      <form onSubmit={handleSubmit}>
        {quiz.questions.map((question, index) => (
          <div key={question.id} className="mb-6 border rounded p-3">
            <div className="d-flex justify-content-between align-items-start">
              <ShowContentQuill className="font-semibold mb-2">
                {index + 1}. {question.question_text}
              </ShowContentQuill>

              <div
                className="position-relative"
                ref={(el) => (dropdownRefs.current[question.id] = el)}
              >
                <button
                  type="button"
                  onClick={() => toggleDropdown(question.id)}
                  className="text-dark font-bold px-2"
                  style={{ fontSize: "1.2em" }}
                >
                  ⋮
                </button>

                {openDropdown === question.id && (
                  <div
                    className="dropdown-menu show shadow-sm"
                    style={{
                      position: "absolute",
                      right: 0,
                      zIndex: 1000,
                      background: "#fff",
                      border: "1px solid #ddd",
                      borderRadius: "6px",
                      padding: "0.3rem 0",
                      minWidth: "140px",
                    }}
                  >
                    <Link
                      href={route("questions.edit", question.id)}
                      className="dropdown-item px-3 py-2 text-dark"
                    >
                      ✏️ Modifier
                    </Link>
                    <button
                      onClick={() => handleDelete(question.id)}
                      className="dropdown-item px-3 py-2 text-danger"
                      style={{
                        background: "none",
                        border: "none",
                        width: "100%",
                        textAlign: "left",
                      }}
                    >
                      🗑️ Supprimer
                    </button>
                  </div>
                )}
              </div>
            </div>

            <div className="ms-4 mt-2">
              {question.answers.map((ans) => (
                <label key={ans.id} className="d-block mb-1">
                  <input
                    type={question.type === "single" ? "radio" : "checkbox"}
                    name={`question_${question.id}`}
                    value={ans.id}
                    checked={answers[question.id]?.includes(ans.id) || false}
                    onChange={() =>
                      handleOptionChange(question.id, ans.id, question.type)
                    }
                  />
                  <span className="ms-2">
                    <ShowContentQuill>{ans.answer_text}</ShowContentQuill>
                  </span>
                </label>
              ))}
            </div>
          </div>
        ))}

        <button
          type="submit"
          className="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
        >
          Soumettre le quiz
        </button>
      </form>
    </AuthLayouts>
  );
};

export default Evaluate;
