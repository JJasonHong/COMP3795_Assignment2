import { ReactNode, useState, useEffect } from "react";
import { Link } from "react-router-dom";
import axios from "axios";
import NavBar from "../components/NavBar";
import LeftSidebar from "../components/LeftSidebar";
import RightSidebar from "../components/RightSidebar";
import PostsList from "../components/PostsList";
import FeaturedPost from "../components/FeaturedPost";
import Footer from "../components/Footer";
import FilterTabs from "../components/FilterTabs";
import Config from "../config";

type HomePageProps = {
  title?: string;
  subtitle?: string;
  children?: ReactNode;
};

export type BlogPost = {
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

type FilterType = 'relevant' | 'latest' | 'top';

const HomePage = ({ title = "DEV Community" }: HomePageProps) => {
  const [activeFilter, setActiveFilter] = useState<FilterType>('relevant');
  const [featuredPosts, setFeaturedPosts] = useState<BlogPost[]>([]);

  // Fetch articles from the Laravel API on component mount
  useEffect(() => {
    axios.get(`${Config.API_BASE_URL}/articles`)
      .then(response => {
        // Assuming the API returns an array of posts directly.
        setFeaturedPosts(response.data.data || response.data);
      })
      .catch(error => {
        console.error("Error fetching articles:", error);
      });
  }, []);

  // Filter posts based on the active filter
  const getFilteredPosts = () => {
    switch (activeFilter) {
      case 'latest':
        return [...featuredPosts].sort((a, b) =>
          new Date(b.CreatDate).getTime() - new Date(a.CreatDate).getTime()
        );
      case 'top':
        return [...featuredPosts].sort((a, b) =>
          (b.reactions || 0) - (a.reactions || 0)
        );
      case 'relevant':
      default:
        return featuredPosts;
    }
  };

  const filteredPosts = getFilteredPosts();

  return (
    <div className="min-vh-100 d-flex flex-column bg-light">
      {/* NavBar */}
      <NavBar title={title} />

      <main className="container flex-grow-1 py-4">
        <div className="row g-4">
          {/* Left Sidebar */}
          <aside className="col-lg-3 d-none d-lg-block">
            <LeftSidebar />
          </aside>

          {/* Main Content */}
          <div className="col-lg-6">
            {/* Filter Tabs */}
            <FilterTabs activeFilter={activeFilter} setActiveFilter={setActiveFilter} />

            {/* Featured Post */}
            {filteredPosts.length > 0 && (
              <FeaturedPost post={filteredPosts[0]} />
            )}

            {/* Challenges Section */}
            <div className="card border-0 shadow-sm mb-4 bg-gradient" style={{ background: 'linear-gradient(135deg, #6366F1, #8B5CF6)' }}>
              <div className="card-body p-4 text-black">
                <h3 className="fw-bold mb-2">DEV CHALLENGES</h3>
                <p className="mb-1 fw-medium">2025 CELEBRATION! MARCH 5 - APRIL 6</p>
                <p className="mb-3">Winner gets their code featured on a permanent DEV page!</p>
                <Link to="/challenges" className="btn btn-light text-primary fw-medium">
                  Join Our First-Ever WeCoded Challenge
                </Link>
              </div>
            </div>

            {/* PostsList with recent posts (excluding featured) */}
            <PostsList posts={filteredPosts.slice(1)} />
          </div>

          {/* Right Sidebar */}
          <aside className="col-lg-3 d-none d-lg-block">
            <RightSidebar />
          </aside>
        </div>
      </main>

      {/* Footer */}
      <Footer title={title} />

      {/* Bootstrap icons & custom styles */}
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
      <style>
        {`
        .transition-hover {
          transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .transition-hover:hover {
          transform: translateY(-3px);
          box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
        }
        .nav-tabs .nav-link.active {
          border-bottom: 2px solid #0d6efd;
          background: transparent;
        }
        .nav-tabs .nav-link:hover:not(.active) {
          border-bottom: 2px solid #e9ecef;
        }
        `}
      </style>
    </div>
  );
};

export default HomePage;