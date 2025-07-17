import { useEffect, useRef, useState } from "react";
import { Head, Link, usePage, router } from "@inertiajs/react";

import CreateSujetModal from "@/Components/CreateSujetModal";
import TutorialGuide from "@/Components/TutorialGuide";
import ShareQuizModal from "@/Components/ShareQuizModal";
import QuizCard from "@/Components/QuizCard";
import { useSearchBar } from "@/Layouts/AuthLayouts";
import AuthLayouts from "@/Layouts/AuthLayouts";

export default function QuizIndex({ myQuizzes, otherQuizzes, flash }) {
  const [messageSuccess, setMessageSuccess] = useState(flash?.success);
  const [activeTab, setActiveTab] = useState("my");
  const [showSujetModal, setShowSujetModal] = useState(false);
  const [showShareModal, setShowShareModal] = useState(false);
  const [selectedQuiz, setSelectedQuiz] = useState(null);

  const [openDropdownId, setOpenDropdownId] = useState(null);
  const dropdownRefs = useRef({});

  const searchKeyword = useSearchBar(); // ✅ déclaration ajoutée

  const { auth } = usePage().props;

  // Tutoriel
  const steps = [
    {
      target: ".newquiz",
      content: "Tu peux créer un nouveau quiz avec plusieurs réponses correctes.",
    },
    {
      target: ".librarys",
      content: "Clique ici pour consulter les quizs des autres utilisateurs.",
    },
    {
      target: ".topic",
      content: "Consulte ici les quiz que tu as créés.",
    },
  ];

  useEffect(() => {
    const handleClickOutside = (event) => {
      if (
        openDropdownId !== null &&
        dropdownRefs.current[openDropdownId] &&
        !dropdownRefs.current[openDropdownId].contains(event.target)
      ) {
        setOpenDropdownId(null);
      }
    };
    document.addEventListener("mousedown", handleClickOutside);
    return () => document.removeEventListener("mousedown", handleClickOutside);
  }, [openDropdownId]);

  const handleDropdownToggle = (quizId) => {
    setOpenDropdownId((prevId) => (prevId === quizId ? null : quizId));
  };

  const handleDelete = (quizId) => {
    if (confirm("Êtes-vous sûr de vouloir supprimer ce quiz ?")) {
      router.delete(route("quizzes.destroy", quizId));
    }
  };

  const renderQuizCard = (quiz) => (
    <div key={quiz.id} className="col-12 col-md-6 col-lg-4 mb-4">
      <QuizCard
        quiz={quiz}
        onShare={(q) => {
          setSelectedQuiz(q);
          setShowShareModal(true);
        }}
      />
    </div>
  );

  const filteredMyQuizzes = myQuizzes.filter(
    (q) =>
      q.title.toLowerCase().includes(searchKeyword.toLowerCase()) ||
      q.description?.toLowerCase().includes(searchKeyword.toLowerCase())
  );

  const filteredOtherQuizzesGrouped = otherQuizzes.data.reduce((acc, quiz) => {
    const match =
      quiz.title.toLowerCase().includes(searchKeyword.toLowerCase()) ||
      quiz.description?.toLowerCase().includes(searchKeyword.toLowerCase());

    if (!match) return acc;

    const cat = quiz.category?.name || "Autres";
    acc[cat] = [...(acc[cat] || []), quiz];
    return acc;
  }, {});

  return (
    <>
      <Head>
        <title>Quiz</title>
      </Head>
      <div>
        <TutorialGuide steps={steps} user={auth.user} />

        <div className="d-md-flex justify-content-between align-items-center mb-4">
          <div className="d-flex justify-content-center gap-3">
            <button
              className={`btn ${
                activeTab === "my" ? "btn-primary" : "btn-outline-primary"
              } fw-bold px-2 py-2`}
              onClick={() => setActiveTab("my")}
            >
              My topics
            </button>
            <button
              className={`btn ${
                activeTab === "library" ? "btn-primary" : "btn-outline-primary"
              } fw-bold px-4 py-2`}
              onClick={() => setActiveTab("library")}
            >
              Library
            </button>
          </div>

          <button
            className="btn btn-primary mt-2 newquiz"
            onClick={() => setShowSujetModal(true)}
          >
            <span className="fs-5">+</span> New quiz
          </button>
        </div>

        <CreateSujetModal
          isOpen={showSujetModal}
          onClose={() => setShowSujetModal(false)}
        />

        <div className="row">
          {activeTab === "my" ? (
            myQuizzes.length > 0 ? (
              filteredMyQuizzes.length > 0 ? (
                filteredMyQuizzes.map(renderQuizCard)
              ) : (
                <div className="text-center text-muted my-5">
                  🧩 Aucun quiz ne correspond à votre recherche.
                </div>
              )
            ) : (
              <div className="text-center text-muted my-5">
                🧩 Aucun quiz créé pour le moment.
              </div>
            )
          ) : (
            <>
              {Object.entries(filteredOtherQuizzesGrouped).length > 0 ? (
                Object.entries(filteredOtherQuizzesGrouped).map(
                  ([category, quizzes]) => (
                    <div key={category} className="mb-5">
                      <h4 className="text-primary mb-3 border-bottom pb-1">
                        {category}
                      </h4>
                      <div className="row">{quizzes.map(renderQuizCard)}</div>
                    </div>
                  )
                )
              ) : (
                <div className="text-center text-muted my-5">
                  🗂️ Aucun quiz ne correspond à votre recherche dans notre
                  bibliothèque.
                </div>
              )}

              {/* PAGINATION */}
              {otherQuizzes.links && (
                <div className="mt-4 d-flex justify-content-center flex-wrap gap-2">
                  {otherQuizzes.links.map((link, i) => (
                    <Link
                      key={i}
                      href={link.url || "#"}
                      dangerouslySetInnerHTML={{ __html: link.label }}
                      className={`mx-1 px-3 py-1 text-sm rounded ${
                        link.active
                          ? "bg-primary text-white"
                          : "bg-light text-dark"
                      } ${!link.url && "text-muted"}`}
                    />
                  ))}
                </div>
              )}
            </>
          )}
        </div>
      </div>

      <ShareQuizModal
        isOpen={showShareModal}
        onClose={() => setShowShareModal(false)}
        quiz={selectedQuiz}
      />
    </>
  );
}

QuizIndex.layout = (page) => <AuthLayouts children={page} />;
