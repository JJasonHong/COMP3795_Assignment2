import { useEffect, useState } from "react";
import { useParams, Link } from "react-router-dom";
import axios from "axios";
import Config from "../config";
import NavBar from "../components/NavBar";
import Footer from "../components/Footer";

type BlogPost = {
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
};

const BlogPostPage = () => {
  const { id } = useParams<{ id: string }>();
  const [post, setPost] = useState<BlogPost | null>(null);
  const [loading, setLoading] = useState<boolean>(true);

  useEffect(() => {
    // Fetch article data from the Laravel API
    axios.get(`${Config.API_BASE_URL}/articles/${id}`)
      .then(response => {
        setPost(response.data.data || response.data);
        setLoading(false);
      })
      .catch(error => {
        console.error("Error fetching article:", error);
        setLoading(false);
      });
  }, [id]);

  if (loading) {
    return (
      <div className="min-vh-100 d-flex flex-column bg-light">
        <NavBar title="DEV Community" />
        <div className="container flex-grow-1 py-5 d-flex justify-content-center align-items-center">
          <div className="spinner-border text-primary" role="status">
            <span className="visually-hidden">Loading...</span>
          </div>
        </div>
        <Footer title="DEV Community" />
      </div>
    );
  }

  if (!post) {
    return (
      <div className="min-vh-100 d-flex flex-column bg-light">
        <NavBar title="DEV Community" />
        <div className="container flex-grow-1 py-5 text-center">
          <div className="card border-0 shadow-sm p-5">
            <h2 className="mb-4">Post not found</h2>
            <p className="text-muted mb-4">The article you're looking for doesn't exist or has been removed.</p>
            <div>
              <Link to="/" className="btn btn-primary px-4">Back to Home</Link>
            </div>
          </div>
        </div>
        <Footer title="DEV Community" />
      </div>
    );
  }

  const formattedDate = new Date(post.CreatDate).toLocaleDateString('en-US', { 
    year: 'numeric', 
    month: 'long', 
    day: 'numeric' 
  });

  return (
    <div className="min-vh-100 d-flex flex-column bg-light">
      <NavBar title="My Blog" />
      
      <main className="container flex-grow-1 py-4">
        <div className="row justify-content-center">
          <div className="col-lg-8">
            <div className="card border-0 shadow-sm mb-4">
              <div className="card-body p-4 p-md-5">
                <div className="mb-4">
                  <Link to="/" className="text-decoration-none d-inline-flex align-items-center text-secondary">
                    <i className="bi bi-arrow-left me-2"></i> Back to blog
                  </Link>
                </div>
                
                <div className="d-flex flex-wrap gap-2 mb-3">
                  {post.category && (
                    <span className="badge bg-primary rounded-pill px-3 py-2">{post.category}</span>
                  )}
                  <span className="text-muted d-flex align-items-center">
                    <i className="bi bi-calendar me-1"></i> {formattedDate}
                  </span>
                  {post.readTime && (
                    <span className="text-muted d-flex align-items-center">
                      <i className="bi bi-clock me-1"></i> {post.readTime} min read
                    </span>
                  )}
                </div>
                
                <h1 className="display-5 fw-bold mb-4">{post.Title}</h1>
                
                <div className="d-flex align-items-center mb-5">
                  <div className="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3" 
                      style={{ width: '50px', height: '50px', fontSize: '1.2rem' }}>
                    {post.ContributorUsername.charAt(0)}
                  </div>
                  <div>
                    <div className="fw-bold">{post.ContributorUsername}</div>
                    <div className="text-muted small">
                      Published on {formattedDate}
                    </div>
                  </div>
                </div>
                
                <div className="blog-content fs-5">
                  <div className="mb-5" style={{ whiteSpace: 'pre-line' }}>
                    {post.Body}
                  </div>

                  <hr className="my-5" />
                  
                  <div className="d-flex justify-content-between align-items-center mt-5">
                    <div className="d-flex gap-3">
                      <button className="btn btn-outline-primary d-flex align-items-center">
                        <i className="bi bi-heart me-2"></i>
                        <span>Like {post.reactions && `(${post.reactions})`}</span>
                      </button>
                      <button className="btn btn-outline-secondary d-flex align-items-center">
                        <i className="bi bi-bookmark me-2"></i>
                        <span>Save</span>
                      </button>
                    </div>
                    <div className="d-flex gap-2">
                      <a href="#" className="btn btn-outline-dark rounded-circle">
                        <i className="bi bi-twitter"></i>
                      </a>
                      <a href="#" className="btn btn-outline-dark rounded-circle">
                        <i className="bi bi-facebook"></i>
                      </a>
                      <a href="#" className="btn btn-outline-dark rounded-circle">
                        <i className="bi bi-linkedin"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div className="card border-0 shadow-sm mb-4">
              <div className="card-body p-4">
                <h3 className="mb-4">Discussion ({post.comments || 0})</h3>
                
                {(post.comments && post.comments > 0) ? (
                  <div className="comment">
                    {/* Comment content would go here */}
                    <p className="text-muted">Loading comments...</p>
                  </div>
                ) : (
                  <div className="text-center py-5">
                    <div className="mb-3">
                      <i className="bi bi-chat-square-text fs-1 text-muted"></i>
                    </div>
                    <h5>No comments yet</h5>
                    <p className="text-muted">Be the first to share your thoughts!</p>
                  </div>
                )}
                
                <form className="mt-4">
                  <div className="mb-3">
                    <label htmlFor="comment" className="form-label fw-bold">Add a comment</label>
                    <textarea className="form-control" id="comment" rows={3} placeholder="Join the discussion..."></textarea>
                  </div>
                  <button type="submit" className="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </main>
      
      <Footer title="My Blog" />
      
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
      <style>
        {`
        .blog-content {
          line-height: 1.8;
        }
        .blog-content p {
          margin-bottom: 1.5rem;
        }
        .transition-hover {
          transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .transition-hover:hover {
          transform: translateY(-3px);
          box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
        }
        `}
      </style>
    </div>
  );
};

export default BlogPostPage;