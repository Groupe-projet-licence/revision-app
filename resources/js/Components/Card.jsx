/**
 * Affichage d'une carte presentant une fiche de revision
 * @param {title:string, description:string, content:string,last_opened_at:string} data 
 */
import { Link, router, useForm, usePage } from '@inertiajs/react'
import { useState } from 'react';
import TutorialGuide from './TutorialGuide';

export default function Card({ data }) {
    const last_review = data.last_opened_at
    const showEditButton = !window.location.pathname.includes('sheets/revision');

    const { auth } = usePage().props;

    const [showDropdown, setShowDropdown] = useState(false);

    //Differentes pop up
    const steps = [{ target: '.delete', content: 'Click here if you want to delete the file you created, but be careful, it will be permanently deleted.', },
    { target: '.edit', content: 'This button allows you to edit the content of your review sheet. Click it to correct or update the information.', },
    { target: '.revise', content: 'This button allows you to review your worksheet using spaced repetition. Click here to reinforce your memorization at the right time.', },
    ];

    return <div key={data.id} className="row-13">

        {/*Affichage du tutoriel*/}
        <TutorialGuide steps={steps} user={auth.user} />

        <div className="mycard d-flex flex-column position-relative"
            style={{
                borderRadius: '15px'
            }}>
            <div className="d-flex flex-column  justify-content-between gap-2" style={{
                aspectRatio: 3 / 1.3,
            }}>
                <div className='d-flex align-items-center p-2'>
                    <div className="mx-2" style={{ fontSize: "2.2em" }}>
                        <i className="bi bi-journal-bookmark text-secondary"></i>
                    </div>
                    <div className='m-2 max-width-title-sheet'>
                        <div
                            style={{
                                overflow: "hidden",
                                textOverflow: "ellipsis",
                                whiteSpace: "nowrap",
                                fontWeight: '600',
                            }}>
                            {data.title}
                        </div>
                        <div className="small-text">
                            {data.description}
                        </div>
                    </div>

                    {/* <div className="three-dots">
                        <i className="bi bi-three-dots text-secondary"></i>
                    </div> */}

                    <div className=" ms-auto three-dots">
                        <button
                            className="btn btn-light text-dark"
                            onClick={() => setShowDropdown(!showDropdown)}
                        >
                            <i className="bi bi-three-dots text-secondary delete"></i>
                        </button>
                        {showDropdown && (
                            <div className="dropdown-menu dropdown-menu-end show"
                                style={{ position: 'absolute', top: 45, right: 50, left: 100 }}>
                                <Link
                                    style={{ color: 'red' }}
                                    as="button"
                                    onClick={() => {
                                        if (confirm('Confirmer la suppression ?')) {
                                            router.delete(route('sheets.destroy', data.id));
                                        }
                                    }}
                                    className="dropdown-item"
                                >
                                   🗑️ Delete
                                </Link>
                            </div>
                        )}
                    </div>



                </div>
                <div className='px-2 pb-2 small-text d-flex justify-content-between align-items-center'>
                    {last_review ? `Last revision: ${last_review}` : 'Never revised'}

                    {/* Catégorie */}
                    {data.category ? (
                        <div style={{ fontSize: '0.75em', color: '#666' }}>
                            📚 {data.category.subject} — {data.category.level}
                        </div>
                    ) : (
                        <div style={{ fontSize: '0.75em', color: '#666' }}>
                            Other
                        </div>
                    )}

                </div>


            </div>
            <div className="text-end">
                <hr />
                {showEditButton &&
                    <Link href={route('sheets.edit', data.id)}
                        className="btn btn-sm btn-outline-primary  my-2 mx-1 fw-bold edit"
                        style={{ fontSize: '0.9em' }}>Edit</Link>}
                <Link href={route('sheets.show', data.id)}
                    className="btn btn-sm btn-outline-primary my-2 ms-1 me-2  fw-bold revise"
                    style={{ fontSize: '0.9em' }}>Review</Link>
            </div>
        </div>
    </div >
}