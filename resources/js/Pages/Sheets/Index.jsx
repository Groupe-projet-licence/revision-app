import { useEffect, useState } from "react";
import Card from "../../Components/Card";
import AuthLayout from "@/Layouts/AuthLayouts";
import { Link } from "@inertiajs/react";

/**
 * Affichage liste de fiches
 *  * @param {{title: string, description:string, content:string}[]} sheets  
 */
export default function Index({ sheets, flash }) {
    const [messageSuccess, setMessageSuccess] = useState(flash.success);
    useEffect(() => {
        if (flash?.success) {
            const timer = setTimeout(() => {
                setMessageSuccess(null)
                window.location.reload();
            }, 3000);
            return () => clearTimeout(timer)
        }
    }, []);
    return <AuthLayout>
        <div>
            {messageSuccess && <div className="alert alert-info flash-messge-success">{messageSuccess}</div>}
            <div className="text-end">
                <Link className="btn btn-primary mb-4" href='/sheets/create'> <span className="fs-5">+</span> New sheet</Link>
            </div>
            <div className="row">
                {sheets.map(sheet => (
                    <Card data={sheet} key={sheet.id} />
                ))}

            </div>
        </div>
    </AuthLayout>
}