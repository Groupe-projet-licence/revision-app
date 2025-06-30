import AuthLayouts from "@/Layouts/AuthLayouts";
import { Link } from "@inertiajs/react";

export default function QuizLibrary({ quizzes = []}) {
    return (
        <AuthLayouts>
            <div className="container">
                <div className="d-flex justify-content-between align-items-center mb-4">
                    <h4 className="fw-bold">Librairie des quiz disponibles</h4>
                    <Link href="/quizzes/create" className="btn btn-primary">
                         + Créer un sujet
                    </Link>
                </div>
                {quizzes.length === 0 && (
                    <div className="text-muted text-center">
                        Aucun quiz disponible pour le moment.
                    </div>
                )}

                <div className="row">
                    {quizzes.map((quiz) => (
                        <div key={quiz.id} className="col-12 col-sm-6 col-lg-4 mb-4">
                            <div className="card h-100 shadow-sm">
                                <div className="card-body">
                                    <div className="d-flex align-items-center mb-2">
                                        <div
                                        className="rounded-circle bg-light d-flex align-items-center justify-content-center"
                                        style={{ width: "40px", height: "40px", fontSize: "1.2em" }}
                                        >
                                        📘
                                        </div>
                                        <div className="ms-2">
                                            <div className="fw-bold">{quiz.category?.subject || "Matière inconnue"}</div>
                                            <div className="text-muted small">
                                                {quiz.user?.name || "Anonyme"}
                                            </div>
                                        </div>
                                    </div>

                                    <p className="mb-1 text-muted small">Nombre de questions : {quiz.questions_count || 0}</p>

                                    {/* Barre de progression factice (tu peux adapter selon stats) */}
                                    <div className="progress" style={{ height: "5px" }}>
                                        <div
                                        className="progress-bar bg-primary"
                                        style={{ width: "0%" }}
                                        ></div>
                                    </div>

                                    <div className="text-end mt-3">
                                        <Link href={route("quizzes.show", quiz.id)} className="btn btn-sm btn-outline-primary">
                                        Vues
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </AuthLayouts>
    );
}