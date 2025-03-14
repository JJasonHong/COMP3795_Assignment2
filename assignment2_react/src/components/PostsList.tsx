import { Link } from "react-router-dom";

export interface BlogPost {
    ArticleId: number;
    Title: string;
    Body: string;
    CreatDate: string;
    StartDate: string;
    EndDate: string;
    ContributorUsername: string;
    created_at: string;
    updated_at: string;
    category?: string;
    readTime?: number;
    comments?: number;
    reactions?: number;
}

type PostsListProps = {
    posts: BlogPost[];
};

const PostsList = ({ posts }: PostsListProps) => {
    return (
        <>
            <h3 className="fw-bold mb-4">Recent Posts</h3>
            <div className="row row-cols-1 g-4 mb-4">
                {posts.map((post) => (
                    <div className="col" key={post.ArticleId}>
                        <div className="card h-100 border-0 shadow-sm transition-hover">
                            <div className="row g-0 align-items-center">
                                {/* Changed to full width */}
                                <div className="col-md-12">
                                    <div className="card-body d-flex flex-column h-100 p-4">
                                        <div className="d-flex align-items-center mb-2">
                                            <div 
                                                className="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2" 
                                                style={{ width: '30px', height: '30px', fontSize: '0.8rem' }}
                                            >
                                                {post.ContributorUsername.charAt(0)}
                                            </div>
                                            <div className="small text-muted">
                                                {post.ContributorUsername} · {post.CreatDate.split(',')[0]}
                                            </div>
                                        </div>
                                        <h4 className="card-title fw-bold mb-2">
                                            <Link to={`/post/${post.ArticleId}`} className="text-decoration-none text-dark stretched-link">
                                                {post.Title}
                                            </Link>
                                        </h4>
                                        <span className="badge bg-primary bg-opacity-10 text-primary mb-2 align-self-start">
                                            {post.category}
                                        </span>
                                        <p className="card-text">{post.Body}</p>
                                        <div className="d-flex mt-auto justify-content-between align-items-center">
                                            <div className="d-flex align-items-center gap-3">
                                                <span className="d-flex align-items-center small">
                                                    <i className="bi bi-heart me-1"></i> {post.reactions}
                                                </span>
                                                <span className="d-flex align-items-center small">
                                                    <i className="bi bi-chat me-1"></i> {post.comments}
                                                </span>
                                            </div>
                                            <div className="text-muted small">
                                                {post.readTime} min read
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                ))}
            </div>
            <div className="text-center mt-4">
                <Link to="/blog" className="btn btn-outline-primary px-4">
                    View All Posts
                </Link>
            </div>
        </>
    );
};

export default PostsList;