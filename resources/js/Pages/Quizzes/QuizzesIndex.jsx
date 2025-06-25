import { useEffect, useState } from "react";
import QuillEditor from "@/Components/QuillEditor";
import AuthLayouts from "@/Layouts/AuthLayouts1";
import { Link } from "@inertiajs/react";

export default function QuizzesIndex() {
  const [quizzes, setQuizzes] = useState([]);

  // Récupérer les quizzes enregistrés
  useEffect(() => {
    const saved = JSON.parse(localStorage.getItem("quizzes") || "[]");
    setQuizzes(saved);
  }, []);

  return (
    <AuthLayouts>
      <div className="text-end">
        <Link className="btn btn-primary mb-4" href="/quizzes/create">
          <span className="fs-5">+</span> New quiz
        </Link>
      </div>

      <div className="container">
        <h4 className="mb-4">Liste de vos Quizz</h4>

        {quizzes.length === 0 && (
          <p className="text-muted">Aucun quiz enregistré pour le moment.</p>
        )}

        {quizzes.map((quiz, idx) => (
          <div key={idx} className="card mb-4">
            <div className="card-body">
              <p><strong>Matière concernée :</strong> (à remplir)</p>
              <p><strong>Titre de la matière :</strong> {quiz.titre}</p>
              <p><strong>Proposé par :</strong> (à remplir)</p>

              <hr />
              <div className="mb-3">
                <strong>Question</strong>
                <div dangerouslySetInnerHTML={{ __html: quiz.question }} className="mb-2" />
                
                {quiz.options.map((opt, i) => (
                  <div className="form-check" key={i}>
                    <input
                      className="form-check-input"
                      type={quiz.multiple ? "checkbox" : "radio"}
                      name={'q${idx}'}
                      disabled
                      checked={quiz.bonnesReponses.includes(i)}
                    />
                    <label className="form-check-label">{opt}</label>
                  </div>
                ))}
              </div>
            </div>
          </div>
        ))}
      </div>
    </AuthLayouts>
  );
}