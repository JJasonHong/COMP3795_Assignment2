import { Link } from "react-router-dom";

const LeftSidebar = () => {
  return (
    <div className="sticky-top pt-3" style={{ top: '80px' }}>
      <div className="card border-0 shadow-sm mb-4">
        <div className="card-body">
          <h5 className="card-title fw-bold mb-3">Navigation</h5>
          <ul className="nav flex-column">
            <li className="nav-item">
              <Link to="/" className="nav-link px-0 py-2 text-primary d-flex align-items-center">
                <i className="bi bi-house-door me-2"></i> Home
              </Link>
            </li>
            <li className="nav-item">
              <Link to="https://podcasts.apple.com/us/browse" className="nav-link px-0 py-2 text-body-secondary d-flex align-items-center">
                <i className="bi bi-mic me-2"></i> Podcasts
              </Link>
            </li>
            <li className="nav-item">
              <Link to="https://www.youtube.com/" className="nav-link px-0 py-2 text-body-secondary d-flex align-items-center">
                <i className="bi bi-play-circle me-2"></i> Videos
              </Link>
            </li>
            <li className="nav-item">
              <Link to="https://rapidtags.io/generator" className="nav-link px-0 py-2 text-body-secondary d-flex align-items-center">
                <i className="bi bi-tags me-2"></i> Tags
              </Link>
            </li>
            <li className="nav-item">
              <Link to="https://www.google.ca/" className="nav-link px-0 py-2 text-body-secondary d-flex align-items-center">
                <i className="bi bi-question-circle me-2"></i> Help
              </Link>
            </li>
          </ul>
        </div>
      </div>
      
      <div className="card border-0 shadow-sm">
        <div className="card-body">
          <h5 className="card-title fw-bold mb-3">Popular Tags</h5>
          <div className="d-flex flex-wrap gap-2">
            <Link to="/tag/javascript" className="badge bg-light text-dark text-decoration-none px-2 py-1">#javascript</Link>
            <Link to="/tag/react" className="badge bg-light text-dark text-decoration-none px-2 py-1">#react</Link>
            <Link to="/tag/webdev" className="badge bg-light text-dark text-decoration-none px-2 py-1">#webdev</Link>
            <Link to="/tag/beginners" className="badge bg-light text-dark text-decoration-none px-2 py-1">#beginners</Link>
            <Link to="/tag/programming" className="badge bg-light text-dark text-decoration-none px-2 py-1">#programming</Link>
          </div>
        </div>
      </div>
    </div>
  );
};

export default LeftSidebar;