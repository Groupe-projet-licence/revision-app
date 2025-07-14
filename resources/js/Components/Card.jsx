/**
 * Affichage d'une carte presentant une fiche de revision
 * @param {title:string, description:string, content:string,last_opened_at:string} data 
 */
import { Link, router, usePage } from '@inertiajs/react'
import { useState, useEffect, useRef } from 'react';
import TutorialGuide from './TutorialGuide';

export default function Card({ data }) {
    const last_review = data.last_opened_at;
    const showEditButton = !window.location.pathname.includes('sheets/revision');

    const { auth } = usePage().props;

    const [openDropdown, setOpenDropdown] = useState(null);
    const dropdownRefs = useRef({});

    // Tutoriel
    const steps = [
        { target: '.delete', content: 'Click here if you want to delete the file you created, but be careful, it will be permanently deleted.', },
        { target: '.edit', content: 'This button allows you to edit the content of your review sheet. Click it to correct or update the information.', },
        { target: '.revise', content: 'This button allows you to review your worksheet using spaced repetition. Click here to reinforce your memorization at the right time.', },
    ];

    // Gestion du clic en dehors pour fermer les dropdowns
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

    const toggleDropdown = (id) => {
        setOpenDropdown((prev) => (prev === id ? null : id));
    };

    const handleDelete = (id) => {
        if (confirm('Would you really delete this sheet ?')) {
            router.delete(route('sheets.destroy', id));
        }
    };

    return (
        <div key={data.id} className="row-13">
            {/* Tutoriel */}
            <TutorialGuide steps={steps} user={auth.user} />

            <div className="mycard d-flex flex-column position-relative"
                style={{ borderRadius: '15px' }}>
                <div className="d-flex flex-column justify-content-between gap-2"
                    style={{ aspectRatio: 3 / 1.3 }}>

                    <div className='d-flex align-items-center p-2'>
                        <div className="mx-2" style={{ fontSize: "2.2em" }}>
                            <i className="bi bi-journal-bookmark text-secondary"></i>
                        </div>

                        <div className='m-2 max-width-title-sheet'>
                            <div style={{
                                overflow: "hidden",
                                textOverflow: "ellipsis",
                                whiteSpace: "nowrap",
                                fontWeight: '600',
                            }}>
                                {data.title}
                            </div>
                            <div className="small-text"
                                style={{ overflow: 'hidden' }}>
                                {data.description}
                            </div>
                        </div>

                        {/* Dropdown menu */}
                        <div className="ms-auto position-relative"
                            ref={(el) => (dropdownRefs.current[data.id] = el)}>
                            <button
                                className="pe-2 text-dark position-absolute"
                                onClick={() => toggleDropdown(data.id)}
                                style={{top:-25, left:-10}}
                            >
                                ⋮
                            </button>

                            {openDropdown === data.id && (
                                <div
                                    className=""
                                    style={{
                                        position: 'absolute',
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
                                    <button
                                        onClick={() => handleDelete(data.id)}
                                        className="px-3 py-2 text-danger"
                                        style={{
                                            background: "none",
                                            border: "none",
                                            width: "100%",
                                            textAlign: "left",
                                        }}
                                    >
                                        🗑️ Delete
                                    </button>
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
                    {showEditButton && (
                        <Link href={route('sheets.edit', data.id)}
                            className="btn btn-sm btn-outline-primary my-2 mx-1 fw-bold edit"
                            style={{ fontSize: '0.9em' }}>
                            Edit
                        </Link>
                    )}
                    <Link href={route('sheets.show', data.id)}
                        className="btn btn-sm btn-outline-primary my-2 ms-1 me-2 fw-bold revise"
                        style={{ fontSize: '0.9em' }}>
                        Review
                    </Link>
                </div>
            </div>
        </div>
    )
}
