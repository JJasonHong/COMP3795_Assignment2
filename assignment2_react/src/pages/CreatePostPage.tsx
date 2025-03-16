import { useState } from "react";
import axios from "axios";
import { useNavigate } from "react-router-dom";
import NavBar from "../components/NavBar";
import Footer from "../components/Footer";
import Config from "../config";

const CreatePostPage = () =>
{
    const navigate = useNavigate(); // ✅ Redirect after successful post creation
    const [ formData, setFormData ] = useState({
        Title: "",
        Body: "",
        ContributorUsername: "",
        category: "",
    });
    const [ loading, setLoading ] = useState(false);
    const [ error, setError ] = useState("");

    // ✅ Handle form field changes
    const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement>) =>
    {
        setFormData({ ...formData, [ e.target.name ]: e.target.value });
    };

    // ✅ Handle form submission
    const handleSubmit = (e: React.FormEvent) =>
    {
        e.preventDefault();
        setLoading(true);
        setError("");

        axios.post(`${ Config.API_BASE_URL }/articles`, formData)
            .then(() =>
            {
                navigate("/blog"); // ✅ Redirect to blog page after successful post
            })
            .catch((err) =>
            {
                setError("Failed to create post. Please try again.");
                console.error(err);
            })
            .finally(() => setLoading(false));
    };

    return (
        <div className="min-vh-100 d-flex flex-column bg-light">
            <NavBar title="My Blog" />
            <main className="container py-4">
                <h2 className="fw-bold mb-3">Create a New Post</h2>
                { error && <div className="alert alert-danger">{ error }</div> }

                {/* ✅ Post Creation Form */ }
                <form onSubmit={ handleSubmit } className="card p-4 shadow-sm border-0">
                    <div className="mb-3">
                        <label className="form-label fw-bold">Title</label>
                        <input
                            type="text"
                            name="Title"
                            className="form-control"
                            placeholder="Enter post title"
                            value={ formData.Title }
                            onChange={ handleChange }
                            required
                        />
                    </div>

                    <div className="mb-3">
                        <label className="form-label fw-bold">Body</label>
                        <textarea
                            name="Body"
                            className="form-control"
                            placeholder="Write your post here..."
                            rows={ 5 }
                            value={ formData.Body }
                            onChange={ handleChange }
                            required
                        />
                    </div>

                    <div className="mb-3">
                        <label className="form-label fw-bold">Your Username</label>
                        <input
                            type="text"
                            name="ContributorUsername"
                            className="form-control"
                            placeholder="Enter your username"
                            value={ formData.ContributorUsername }
                            onChange={ handleChange }
                            required
                        />
                    </div>

                    <div className="mb-3">
                        <label className="form-label fw-bold">Category</label>
                        <input
                            type="text"
                            name="category"
                            className="form-control"
                            placeholder="Enter category (optional)"
                            value={ formData.category }
                            onChange={ handleChange }
                        />
                    </div>

                    <button type="submit" className="btn btn-primary" disabled={ loading }>
                        { loading ? "Posting..." : "Create Post" }
                    </button>
                </form>
            </main>
            <Footer title="Create Post" />
        </div>
    );
};

export default CreatePostPage;
