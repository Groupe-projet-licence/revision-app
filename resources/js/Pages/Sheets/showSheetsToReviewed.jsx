import { createContext, useEffect, useState } from "react";
import Card from "../../Components/Card";
import AuthLayout from "@/Layouts/AuthLayouts";
import { Head } from "@inertiajs/react";

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
        <Head>
            <title>Revision</title>
        </Head>
        <div>
            {messageSuccess && <div className="alert alert-info flash-messge-success">{messageSuccess}</div>}
            {
                sheets.length === 0 ?
                    <h1>🗂️ No files to review at the moment !!</h1>
                    :
                    <div className="container-grid-css-card">
                        {sheets.map(sheet => (
                            <Card data={sheet} key={sheet.id} />
                        ))}

                    </div>
            }
        </div>
    </AuthLayout>
}