/**
 * Affichage d'une carte presentant une fiche de revision
 * @param {title:string, description:string, content:string} data 
 */
import { Link, router } from '@inertiajs/react'
export default function Card({ data }) {

    return <div key={data.id} className="col-8 col-sm-6 col-md-5 col-lg-4 col-xl-3 mb-4">
        <div className="mycard d-flex flex-column  justify-content-between"
            style={{ aspectRatio: 3 / 1.9, 
            borderRadius:'9px' }}>
            <div>
                <div className='m-2'>
                    <div
                        style={{
                            overflow: "hidden",
                            textOverflow: "ellipsis",
                            whiteSpace: "nowrap",
                            fontWeight: '500',

                        }}>
                        {data.title}
                    </div>
                    <div style={{ fontSize: '0.9em' }}>
                        {data.description}
                    </div>
                </div>
            </div>
            <div className="text-end">
                <hr />
                <Link href={route('sheets.show', data.id)}
                    className="btn btn-outline-primary m-2 fw-bold"
                    style={{ fontSize: '0.9em' }}>Voir</Link>
            </div>
        </div>
    </div >
}