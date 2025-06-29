/**
 * Fiche de revision a afficher
 * @param {{title: string, description:string, content:string}} sheet 
 * 
 */

import ShowContentQuill from "@/Components/ShowContentQuill";
import AuthLayouts from "@/Layouts/AuthLayouts";


export default function Show({ sheet }) {
    return <AuthLayouts>
        <div>
            <ShowContentQuill>{sheet.content} </ShowContentQuill>
        </div>
    </AuthLayouts>
}