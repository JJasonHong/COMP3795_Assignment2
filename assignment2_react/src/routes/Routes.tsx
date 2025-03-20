import { createBrowserRouter } from "react-router-dom";
import HomePage from "../pages/HomePage";
import App from "../App";
import NotFoundPage from "../components/NotFoundPage";
import BlogPostPage from "../pages/BlogPostPage"; // You'll need to create this component
import BlogPage from "../pages/BlogPage"; // For all articles
import CreatePostPage from "../pages/CreatePostPage"; // Create post

/**
* The router configuration for the application.
*/
export const router = createBrowserRouter([
  {
    path: "/",
    element: <App />,
    children: [
      {
        path: "/",
        element: (
          <HomePage
            title="My Blog"
            subtitle="Thoughts, stories and ideas"
          />
        ),
      },
      {
        path: "/post/:id",
        element: <BlogPostPage />,
      },
      {
        path: "*",
        element: <NotFoundPage />,
      },
      {
        path: "/blog", // View all articles
        element: <BlogPage />,
      },
      {
        path: "/create", // Create a post
        element: <CreatePostPage />,
      },
    ],
  },
]);