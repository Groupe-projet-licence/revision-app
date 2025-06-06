import { createContext, useEffect, useState } from "react";
import Card from "../../Components/Card";
import AuthLayout from "@/Layouts/AuthLayouts";

/**
 * Affichage liste de fiches
 *  * @param {{title: string, description:string, content:string}[]} sheets  
 */
export default function showSheetsToReviewed({ sheets, flash }) {
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
            {
                sheets.length === 0 ?
                    <h1>Aucune fiche à reviser pour le moment!!</h1>
                    :
                    <div className="row">
                        {sheets.map(sheet => (
                            <Card data={sheet} key={sheet.id} />
                        ))}

                    </div>
            }
        </div>
    </AuthLayout>
}