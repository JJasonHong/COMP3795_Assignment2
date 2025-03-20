import { Link } from "react-router-dom";

const RightSidebar = () => {
  return (
    <div className="sticky-top pt-3" style={{ top: "80px" }}>
      <div className="card border-0 shadow-sm mb-4">
        <div className="card-body">
          <h5 className="fw-bold d-flex align-items-center mb-3">
            <i className="bi bi-fire text-danger me-2"></i> Trending
          </h5>
          <div className="list-group list-group-flush">
            <Link
              to="https://www.google.ca/"
              className="list-group-item list-group-item-action border-0 px-0"
            >
              <div className="fw-medium">KendoReact Challenge</div>
              <div className="small text-muted">Win $5000 in prizes</div>
            </Link>
            <Link
              to="https://www.google.ca/"
              className="list-group-item list-group-item-action border-0 px-0"
            >
              <div className="fw-medium">Future Writing Challenge</div>
              <div className="small text-muted">Submit by March 30</div>
            </Link>
          </div>
        </div>
      </div>

      <div className="card border-0 shadow-sm">
        <div className="card-header bg-primary text-white fw-bold border-0">
          Subscribe to Newsletter
        </div>
        <div className="card-body">
          <p className="card-text small">
            Get the latest posts and updates delivered to your inbox.
          </p>
          <form>
            <div className="mb-3">
              <input
                type="email"
                className="form-control"
                placeholder="Your email address"
              />
            </div>
            <button type="submit" className="btn btn-primary w-100">
              Subscribe
            </button>
          </form>
        </div>
      </div>
    </div>
  );
};

export default RightSidebar;