import React from 'react';
import { useForm, Link, usePage, Head } from '@inertiajs/react';
import AuthLayout from '@/Layouts/AuthLayouts';

export default function UserIndex() {
    const { users, flash } = usePage().props;

    return (
        <AuthLayout>
            <div className="">
                <h2 className="mb-4">User managment</h2>


                {flash.success && (
                    <div className="alert alert-success">{flash.success}</div>
                )}

                <table className="table table-bordered">
                    <thead className="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Modifier</th>
                        </tr>
                    </thead>
                    <tbody>
                        {users.map((user, index) => (
                            <UserRow key={user.id} user={user} index={index + 1} />
                        ))}
                    </tbody>
                </table>
            </div>
        </AuthLayout>
    );
}

function UserRow({ user, index }) {
    const { data, setData, put, processing } = useForm({
        role: user.role,
    });

    const handleChange = (e) => {
        setData('role', e.target.value);
        put(route('admin.users.update', user.id));
    };

    return (
        <>
            <Head>
                <title>Admin</title>
            </Head>
            <tr>
                <td>{index}</td>
                <td>{user.name}</td>
                <td>{user.email}</td>
                <td>{user.role}</td>
                <td>
                    <select className="form-select form-select-sm" value={data.role} onChange={handleChange} disabled={processing} >
                        <option value="user">Utilisateur</option>
                        <option value="admin">Administrateur</option>
                    </select>
                </td>
            </tr>   
        </>
    );
}