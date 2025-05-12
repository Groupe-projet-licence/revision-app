/**
 * Fiche de revision a afficher
 * @param {{title: string, description:string, content:string}} sheet 
 * 
 */


export default function Show({ sheet }) {
    return <div className="rounded-3 container"
        dangerouslySetInnerHTML={{ __html: sheet.content }} />
}