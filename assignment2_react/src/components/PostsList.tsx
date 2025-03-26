/**
 * This is used to display all active articles from the database with infinite scrolling.
 */
import {useState, useEffect, useRef} from "react";
import {Link} from "react-router-dom";

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
}

type PostsListProps = {
  posts: BlogPost[];
};

const PostsList = ({posts}: PostsListProps) => {
  // Filter posts to show only those within their start and end date range
  const currentDate = new Date().toISOString();

  // Filter posts that are currently active (between start and end dates)
  const activePosts = posts.filter((post) => {
    const startDate = new Date(post.StartDate).toISOString();
    const endDate = new Date(post.EndDate).toISOString();
    return startDate <= currentDate && currentDate <= endDate;
  });

  const [visiblePosts, setVisiblePosts] = useState<BlogPost[]>([]);
  const [postsToShow, setPostsToShow] = useState(5);
  const [loading, setLoading] = useState(false);
  const loaderRef = useRef<HTMLDivElement>(null);

  // Load initial set of posts
  useEffect(() => {
    // Make sure we have at least one post to show
    setVisiblePosts(activePosts.slice(0, Math.max(1, postsToShow)));
  }, [activePosts, postsToShow]);

  // Set up Intersection Observer for infinite scrolling
  useEffect(() => {
    const observer = new IntersectionObserver(
      (entries) => {
        const target = entries[0];
        if (
          target.isIntersecting &&
          !loading &&
          visiblePosts.length < activePosts.length
        ) {
          loadMorePosts();
        }
      },
      {
        rootMargin: "100px", // Load before fully reaching the element
        threshold: 0.1, // Trigger when just 10% is visible
      }
    );

    if (loaderRef.current) {
      observer.observe(loaderRef.current);
    }

    return () => {
      if (loaderRef.current && observer) {
        observer.unobserve(loaderRef.current);
      }
    };
  }, [visiblePosts.length, loading, activePosts.length]);

  const loadMorePosts = () => {
    if (loading) return;

    setLoading(true);
    setTimeout(() => {
      setPostsToShow((prev) => {
        const newCount = prev + 5;
        setVisiblePosts(activePosts.slice(0, newCount));
        return newCount;
      });
      setLoading(false);
    }, 500);
  };

  if (!activePosts.length) {
    return (
      <div className="alert alert-info text-center py-4">
        <i className="bi bi-calendar-x me-2 fs-4 d-block mb-3"></i>
        <h5>No Active Posts</h5>
        <p className="mb-0">
          There are no posts currently published within their active date range.
        </p>
      </div>
    );
  }

  return (
    <>
      <h3 className="fw-bold mb-4">Recent Posts</h3>
      <div className="row row-cols-1 g-4 mb-4">
        {visiblePosts.map((post, index) => (
          <div className="col" key={post.ArticleId}>
            <div className="card h-100 border-0 shadow-sm transition-hover">
              <div className="row g-0 align-items-center">
                <div className="col-md-12">
                  <div className="card-body d-flex flex-column h-100 p-4">
                    <div className="d-flex align-items-center mb-2">
                      <div
                        className="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2"
                        style={{
                          width: "30px",
                          height: "30px",
                          fontSize: "0.8rem",
                        }}
                      >
                        {post.ContributorUsername.charAt(0)}
                      </div>
                      <div className="small text-muted">
                        {post.ContributorUsername} ·{" "}
                        {post.CreatDate.split(",")[0]}
                      </div>
                    </div>
                    <h4 className="card-title fw-bold mb-2">
                      <Link
                        to={`/post/${post.ArticleId}`}
                        className="text-decoration-none text-dark stretched-link"
                      >
                        {post.Title}
                      </Link>
                    </h4>
                    <div className="d-flex gap-2 mb-2 small text-muted">
                      <span title="Available from">
                        <i className="bi bi-calendar-check me-1"></i>
                        {new Date(post.StartDate).toLocaleDateString()} -{" "}
                        {new Date(post.EndDate).toLocaleDateString()}
                      </span>
                    </div>
                    <p className="card-text">
                      {post.Body.length > 150
                        ? `${post.Body.substring(0, 150)}...`
                        : post.Body}
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        ))}
      </div>

      {/* Loader - make sure it's tall enough to be visible */}
      {visiblePosts.length < activePosts.length && (
        <div
          ref={loaderRef}
          className="text-center my-4 py-4"
          style={{minHeight: "100px"}}
        >
          {loading ? (
            <div className="spinner-border text-primary" role="status">
              <span className="visually-hidden">Loading...</span>
            </div>
          ) : (
            <div className="text-muted">Loading more posts...</div>
          )}
        </div>
      )}
    </>
  );
};

export default PostsList;
