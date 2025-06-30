/**
 * Affichage d'une carte presentant une fiche de revision
 * @param {title:string, description:string, content:string,last_opened_at:string} data 
 */
import { Link, router } from '@inertiajs/react'
export default function Card({ data }) {
    const last_review = data.last_opened_at
    const showEditButton = !window.location.pathname.includes('sheets/revision')

    return <div key={data.id} className="row-13">
        <div className="mycard d-flex flex-column "
            style={{
                borderRadius: '15px'
            }}>
            <div className="d-flex flex-column  justify-content-between gap-2"  style={{
                 aspectRatio: 3 / 1.3,
            }}>
                <div className='d-flex align-items-center p-2'>
                    <div className="mx-2" style={{fontSize:"2.2em"}}>
                        <i className="bi bi-journal-bookmark text-secondary"></i>
                    </div>
                    <div className='m-2'>
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
                    <div className="three-dots">
                        <i className="bi bi-three-dots text-secondary"></i>
                    </div>
                </div>
                <div className='px-2 pb-2 small-text d-flex justify-content-between align-items-center'>
                    {last_review ? `Last revision: ${last_review}` : 'Never revised'}

                    {/* Catégorie */}
                    {data.category ? (
                        <div style={{ fontSize: '0.75em', color: '#666' }}>
                        📚 {data.category.subject} — Niveau {data.category.level}
                        </div>
                    ) : (
                        <div style={{ fontSize: '0.75em', color: '#666' }}>
                        Autre
                        </div>
                    )}

                </div>


            </div>
            <div className="text-end">
                <hr />
                {showEditButton &&
                <Link href={route('sheets.edit', data.id)}
                    className="btn btn-sm btn-outline-primary  my-2 mx-1 fw-bold"
                    style={{ fontSize: '0.9em' }}>Edit</Link>}
                <Link href={route('sheets.show', data.id)}
                    className="btn btn-sm btn-outline-primary my-2 ms-1 me-2  fw-bold"
                    style={{ fontSize: '0.9em' }}>Review</Link>
            </div>
        </div>
    </div >
}