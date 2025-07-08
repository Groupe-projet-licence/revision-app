import { useEffect, useState } from "react";
import { Head, Link, usePage } from "@inertiajs/react";
import CreateSujetModal from "@/Components/CreateSujetModal";
import TutorialGuide from "@/Components/TutorialGuide";
import { useSearchBar } from "@/Layouts/AuthLayouts";;
import AuthLayouts from "@/Layouts/AuthLayouts";

export default function QuizIndex({ myQuizzes, otherQuizzes, flash }) {
  const [messageSuccess, setMessageSuccess] = useState(flash?.success);
  const [activeTab, setActiveTab] = useState("my"); // 'my' ou 'library'
  //const [quizzes, setQuizzes] = useState([]);
  const [showSujetModal, setShowSujetModal] = useState(false);

  const { auth } = usePage().props;

  //Differentes pop up
  const steps = [ { target: '.newquiz', content:'Tu peux crée un nouveau et ajoute le nombres de reponses que tu souhaite et defini plusieurs bonne reponse'},
                  { target:'.librarys', content:'Clique sur le button pour consulter les quizs des autres utilisateurs ou tu pouras aussi evalue.',},
                  { target:'.topic', content:'Ici tu peux consulter les quiz que ta crée et d\'autovalue dessus.',}, 
                ]

  // QuizzesIndex

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
          <Link href={route('quiz.evaluate', quiz.id)}
            className="btn btn-sm btn-outline-primary my-2 me-2 fw-bold"
            style={{ fontSize: '0.9em' }}>
            ASSESSMENT
          </Link>


          <Link href={route('quizzes.show', quiz.id)}
            className="btn btn-sm btn-outline-primary my-2 me-2 fw-bold"
            style={{ fontSize: '0.9em' }}>
            View
          </Link>


          <button
            className="btn btn-sm btn-outline-primary my-2 me-2 fw-bold"
            onClick={() => navigator.clipboard.writeText(route('quiz.evaluate', quiz.id))}
            style={{ fontSize: '0.9em' }}>
            🔗 Share Quiz
          </button>

        </div>
      </div>
    </div>
  );

  // 🔍 Filtrage par recherche (titre ou description)
  const searchKeyword = useSearchBar();  
 
    
  return (
    <>
      <Head>
        <title>Quiz</title>
      </Head>
      <div>
        {/* Affichage du tutoriel */}
        <TutorialGuide steps={steps} user={auth.user}/>


        
        <div className="d-flex justify-content-between align-items-center  mb-4">
          {/* Boutons de filtre */}
          <div className="d-flex justify-content-center gap-3">
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

          <button className="btn btn-primary" onClick={() => setShowSujetModal(true)}>
            <span className="fs-5">+</span> New quizz
          </button>
            
        </div>

        {/* MODALE DE CRÉATION DE SUJET */}
        <CreateSujetModal
          isOpen={showSujetModal}
          onClose={() => setShowSujetModal(false)}
        />


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
            // 🔄 REMPLACER CETTE PARTIE
            otherQuizzes.data && (
              <>
                <div className="mb-4">
                  {Object.entries(
                    otherQuizzes.data.reduce((acc, quiz) => {
                      const cat = quiz.category?.name || 'Autres';
                      acc[cat] = [...(acc[cat] || []), quiz];
                      return acc;
                    }, {})
                  ).map(([category, quizzes]) => (
                    <div key={category} className="mb-5">
                      <h4 className="text-primary mb-3 border-bottom pb-1">{category}</h4>
                      <div className="row">
                        {quizzes.map(renderQuizCard)}
                      </div>
                    </div>
                  ))}
                </div>

                {/* PAGINATION */}
                {otherQuizzes.links && (
                  <div className="mt-4 d-flex justify-content-center flex-wrap gap-2">
                    {otherQuizzes.links.map((link, i) => (
                      <Link
                        key={i}
                        href={link.url || '#'}
                        dangerouslySetInnerHTML={{ __html: link.label }}
                        className={`mx-1 px-3 py-1 text-sm rounded ${link.active ? 'bg-primary text-white' : 'bg-light text-dark'
                          } ${!link.url && 'text-muted'}`}
                      />
                    ))}
                  </div>
                )}
              </>
            )
          )}
        </div>

      </div>
    </>
  );
}


QuizIndex.layout = page => <AuthLayouts children={page} />