import { useEffect, useState } from "react";
import Card from "../../Components/Card";
import AuthLayout from "@/Layouts/AuthLayouts";

/**
 * Affichage liste de fiches
 *  * @param {{title: string, description:string, content:string}[]} sheets  
 */
export default function Index({ sheets, flash }) {
    const [messageSuccess, setMessageSuccess] = useState(flash.success);
    console.log(flash?.success);
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
            <div className="row">
                {sheets.map(sheet => (
                    <Card data={sheet} key={sheet.id} />
                ))}

            </div>
        </div>
    </AuthLayout>
}