import { useEffect, useState } from "react";
import Card from "../../Components/Card";

/**
 * Affichage liste de fiches
 *  * @param {{title: string, description:string, content:string}[]} sheets  
 */
export default function Index({ sheets, flash }) {
    const [messageSuccess, setMessageSuccess] = useState(flash.success);
    useEffect(() => {
        const timer = setTimeout(() => setMessageSuccess(null), 3000);
        return () => clearTimeout(timer)
    }, []);
    return <div className="container my-5">
        {messageSuccess && <div className="alert alert-info flash-messge-success">{messageSuccess}</div>}
        <div className="row">
            {sheets.map(sheet => (
                <Card data={sheet} key={sheet.id} />
            ))}

        </div>
    </div>
}