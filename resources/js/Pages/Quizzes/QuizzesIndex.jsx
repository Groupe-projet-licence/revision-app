import { useEffect, useState } from "react";
import AuthLayout from "@/Layouts/AuthLayouts";
//import AuthLayouts from "@/Layouts/AuthLayouts";
import { Link, usePage } from "@inertiajs/react";
import CreateSujetModal from "@/Components/CreateSujetModal";

export default function QuizIndex({ myQuizzes, otherQuizzes, flash }) {
  const [messageSuccess, setMessageSuccess] = useState(flash?.success);
  const [activeTab, setActiveTab] = useState("my"); // 'my' ou 'library'
  //const [quizzes, setQuizzes] = useState([]);
  const [showSujetModal, setShowSujetModal] = useState(false);
  // QuizzesIndex

  useEffect(() => {
    if (messageSuccess) {
      const timer = setTimeout(() => setMessageSuccess(null), 3000);
      return () => clearTimeout(timer);
    }
  }, [messageSuccess]);

  const renderQuizCard = (quiz) => (
    <div key={quiz.id} className="col-8 col-sm-6 col-md-5 col-lg-4 col-xl-3 mb-4">
      <div className="mycard d-flex flex-column justify-content-between"
        style={{ aspectRatio: 3 / 1.9, borderRadius: '9px' }}>
        <div className="m-2">
          <div style={{
            overflow: "hidden",
            textOverflow: "ellipsis",
            whiteSpace: "nowrap",
            fontWeight: '500'
          }}>
            {quiz.title}
          </div>
          <div style={{ fontSize: '0.9em' }}>
            {quiz.description || 'Aucune description.'}
          </div>
        </div>
        <div className="text-end">
          <hr />
          {quiz.can_edit && (
            <Link href={route('quizzes.edit', quiz.id)}
              className="btn btn-sm btn-outline-primary my-2 mx-1 fw-bold"
              style={{ fontSize: '0.9em' }}>
              Edit
            </Link>
          )}
          <Link href={route('quiz.evaluate',quiz.id)}
            className="btn btn-sm btn-outline-primary my-2 me-2 fw-bold"
            style={{ fontSize: '0.9em' }}>
            ASSESSMENT
          </Link>


          <Link href={route('quizzes.show', quiz.id)}
            className="btn btn-sm btn-outline-primary my-2 me-2 fw-bold"
            style={{ fontSize: '0.9em' }}>
            View
          </Link>
        </div>
      </div>
    </div>
  );

  return (
    <AuthLayout>
      <div>
        {messageSuccess && <div className="alert alert-info">{messageSuccess}</div>}
        <div className="text-end">
          <button className="btn btn-primary mb-4" onClick={() => setShowSujetModal(true)}>
            <span className="fs-5">+</span> New quizz
          </button>
        </div>

        {/* MODALE DE CRÉATION DE SUJET */}
        <CreateSujetModal
          isOpen={showSujetModal}
          onClose={() => setShowSujetModal(false)}
        />

        {/* Boutons de filtre */}
        <div className="d-flex justify-content-center mb-4 gap-3">
          <button
            className={`btn ${activeTab === 'my' ? 'btn-primary' : 'btn-outline-primary'} fw-bold px-4 py-2`}
            onClick={() => setActiveTab('my')}
          >
            My topics {/*<span className="badge">{myQuizzes}</span>  */}
          </button>
          <button
            className={`btn ${activeTab === 'library' ? 'btn-primary' : 'btn-outline-primary'} fw-bold px-4 py-2`}
            onClick={() => setActiveTab('library')}
          >
            Librairy
          </button>
        </div>

        {/* Affichage conditionnel */}
        <div className="row">
          {activeTab === 'my' ? (
            myQuizzes.length > 0 ? (
              myQuizzes.map(renderQuizCard)
            ) : (
              <div className="text-center text-muted my-5">
                🧩 Aucun quiz créé pour le moment.
              </div>
            )
          ) : (
            otherQuizzes.length > 0 ? (
              otherQuizzes.map(renderQuizCard)
            ) : (
              <div className="text-center text-muted my-5">
                📚 Aucun quiz disponible dans la bibliothèque.
              </div>
            )
          )}
        </div>
      </div>
    </AuthLayout>
  );
}
