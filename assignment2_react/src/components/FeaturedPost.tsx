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

type FeaturedPostProps = {
    post: BlogPost;
};

const FeaturedPost = ({ post }: FeaturedPostProps) => {
  return (
    <div className="card border-0 shadow-sm mb-4 overflow-hidden">
      {/* <img
        src={post.image}
        className="card-img-top"
        alt={post.Title}
        style={{ height: "300px", objectFit: "cover" }}
      /> */}
      <div className="card-body p-4">
        <div className="d-flex align-items-center mb-3">
          <div
            className="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2"
            style={{ width: "40px", height: "40px" }}
          >
            {post.ContributorUsername.charAt(0)}
          </div>
          <div>
            <div className="fw-bold">{post.ContributorUsername}</div>
            <div className="text-muted small">
              {post.CreatDate.split(",")[0]} · {post.readTime} min read
            </div>
          </div>
        </div>
        <h2 className="card-title fw-bold mb-3">
          <Link
            to={`/post/${post.ArticleId}`}
            className="text-decoration-none text-dark stretched-link"
          >
            {post.Title}
          </Link>
        </h2>
        <div className="mb-3">
          <span className="badge bg-primary rounded-pill px-3 py-2">
            {post.category}
          </span>
        </div>
        <p className="card-text lead">{post.Body}</p>
        <div className="d-flex justify-content-between align-items-center mt-4">
          <div className="d-flex align-items-center gap-3">
            <span className="d-flex align-items-center">
              <i className="bi bi-heart me-1"></i> {post.reactions}
            </span>
            <span className="d-flex align-items-center">
              <i className="bi bi-chat me-1"></i> {post.comments}
            </span>
          </div>
          <div className="text-muted small">{post.readTime} min read</div>
        </div>
      </div>
    </div>
  );
};

export default FeaturedPost;