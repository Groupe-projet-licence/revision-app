import { Link, router, usePage } from "@inertiajs/react";
import { useRef, useState, useEffect } from "react";
import TutorialGuide from "./TutorialGuide";

export default function QuizCard({ quiz, onShare }) {
  const { auth } = usePage().props;
  const [openDropdown, setOpenDropdown] = useState(null);
  const dropdownRefs = useRef({});

  const handleDelete = (id) => {
    if (confirm("Voulez-vous vraiment supprimer ce quiz ?")) {
      router.delete(route("quizzes.destroy", id));
    }
  };

  const toggleDropdown = (id) => {
    setOpenDropdown((prev) => (prev === id ? null : id));
  };

  useEffect(() => {
    const handleClickOutside = (e) => {
      Object.entries(dropdownRefs.current).forEach(([id, ref]) => {
        if (ref && !ref.contains(e.target)) {
          setOpenDropdown(null);
        }
      });
    };
    document.addEventListener("mousedown", handleClickOutside);
    return () => document.removeEventListener("mousedown", handleClickOutside);
  }, []);

  const steps = [
    { target: ".revisequiz", content: "Clique ici pour faire une évaluation de ton quiz." },
    { target: ".sharequiz", content: "Partage ton quiz avec tes camarades." },
  ];

  return (
    <div className="row-13">
      <TutorialGuide steps={steps} user={auth.user} />
      <div className="mycard d-flex flex-column position-relative" style={{ borderRadius: "15px" }}>
        <div className="d-flex flex-column justify-content-between gap-2" style={{ aspectRatio: 3 / 1.3 }}>
          <div className="d-flex align-items-center p-2">
            <div className="mx-2" style={{ fontSize: "2.2em" }}>
              <i className="bi bi-clipboard-check text-primary"></i>
            </div>

            <div className="m-2 max-width-title-sheet">
              <div
                style={{
                  overflow: "hidden",
                  textOverflow: "ellipsis",
                  whiteSpace: "nowrap",
                  fontWeight: "600",
                }}
              >
                {quiz.title}
              </div>
              <div className="small-text" style={{ overflow: "hidden" }}>
                {quiz.description || "Aucune description"}
              </div>
            </div>

            {quiz.can_edit && (
              <div className="ms-auto position-relative" ref={(el) => (dropdownRefs.current[quiz.id] = el)}>
                <button
                  className="pe-2 text-dark position-absolute"
                  onClick={() => toggleDropdown(quiz.id)}
                  style={{ top: -25, left: -10 }}
                >
                  ⋮
                </button>

                {openDropdown === quiz.id && (
                  <div
                    className=""
                    style={{
                      position: "absolute",
                      top: 5,
                      left: -155,
                      zIndex: 1000,
                      background: "#fff",
                      border: "1px solid #ddd",
                      borderRadius: "6px",
                      padding: "0.3rem 0",
                      minWidth: "140px",
                    }}
                  >
                    <Link href={route("quizzes.edit", quiz.id)} className="px-3 py-2 text-dark d-block">
                      ✏️ Edit
                    </Link>
                    <button
                      onClick={() => handleDelete(quiz.id)}
                      className="px-3 py-2 text-danger d-block"
                      style={{ background: "none", border: "none", width: "100%", textAlign: "left" }}
                    >
                      🗑️ Delete
                    </button>
                  </div>
                )}
              </div>
            )}
          </div>

          <div className="px-2 pb-2 small-text d-flex justify-content-between align-items-center">
            {quiz.category ? (
              <div style={{ fontSize: "0.75em", color: "#666" }}>
                📚 {quiz.category.name}
              </div>
            ) : (
              <div style={{ fontSize: "0.75em", color: "#666" }}>
                   Others
              </div>
            )}
          </div>
        </div>

        <div className="text-end">
          <hr />
          <Link
            href={route("quiz.evaluate", quiz.id)}
            className="btn btn-sm btn-outline-primary my-2 mx-1 fw-bold revisequiz"
            style={{ fontSize: "0.9em" }}
          >
            Assessment
          </Link>
          <Link
            href={route("quizzes.show", quiz.id)}
            className="btn btn-sm btn-outline-primary my-2 mx-1 fw-bold"
            style={{ fontSize: "0.9em" }}
          >
            View
          </Link>
          <button
            className="btn btn-sm btn-outline-primary my-2 mx-1 fw-bold sharequiz"
            style={{ fontSize: "0.9em" }}
            onClick={() => onShare(quiz)}
          >
            ✉️ Share
          </button>
        </div>
      </div>
    </div>
  );
}
