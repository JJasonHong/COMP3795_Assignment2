import { useState, useEffect } from "react";
import axios from "axios";
import { useSearchParams } from "react-router-dom";
import NavBar from "../components/NavBar";
import PostsList from "../components/BlogPostList";
import Config from "../config";

const BlogPage = () =>
{
    const [ articles, setArticles ] = useState([]); // Store all articles
    const [ searchParams, setSearchParams ] = useSearchParams(); // Get page from URL
    const currentPage = parseInt(searchParams.get("page") || "1", 10); // Get current page
    const postsPerPage = 10;

    useEffect(() =>
    {
        axios.get(`${ Config.API_BASE_URL }/articles`)
            .then(response =>
            {
                setArticles(response.data.data || response.data);
            })
            .catch(error => console.error("Error fetching articles:", error));
    }, []);

    const totalPages = Math.ceil(articles.length / postsPerPage); // 
    const indexOfLastPost = currentPage * postsPerPage;
    const indexOfFirstPost = indexOfLastPost - postsPerPage;
    const currentPosts = articles.slice(indexOfFirstPost, indexOfLastPost);

    // change page & scroll to top
    const handlePageChange = (page: number) =>
    {
        setSearchParams({ page: page.toString() });
        window.scrollTo({ top: 0, behavior: "smooth" }); // Scroll to top
    };

    return (
        <div className="min-vh-100 d-flex flex-column bg-light">
            <NavBar title="All Articles" />
            <main className="container py-4">
                <h2 className="fw-bold mb-3">All Articles</h2>
                <PostsList posts={ currentPosts } /> {/* Show paginated posts */ }

                {/* Pagination buttons */ }
                <div className="text-center mt-4">
                    {/* Previous Button */ }
                    <button
                        className="btn btn-outline-primary me-2"
                        disabled={ currentPage === 1 }
                        onClick={ () => handlePageChange(currentPage - 1) }
                    >
                        Previous
                    </button>

                    {/* Page Number Buttons */ }
                    { Array.from({ length: totalPages }, (_, i) => (
                        <button
                            key={ i + 1 }
                            className={ `btn mx-1 ${ currentPage === i + 1 ? 'btn-primary' : 'btn-outline-primary' }` }
                            onClick={ () => handlePageChange(i + 1) }
                        >
                            { i + 1 }
                        </button>
                    )) }

                    {/* Next Button */ }
                    <button
                        className="btn btn-outline-primary ms-2"
                        disabled={ currentPage >= totalPages }
                        onClick={ () => handlePageChange(currentPage + 1) }
                    >
                        Next
                    </button>
                </div>
            </main>
        </div>
    );
};

export default BlogPage;
