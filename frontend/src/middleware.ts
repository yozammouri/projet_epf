// export { auth as middleware } from "@/auth"
 
import { auth } from "@/auth";

export default auth((req) => {
  const { pathname, origin } = req.nextUrl;

  // Redirect logged-in users away from /login and /home to their respective dashboards
  if (req.auth && (pathname === "/login" || pathname === "/home")) {
    const urlCoordinateur = new URL("/coordinateur", origin);
    const urlApprenant = new URL("/apprenant", origin);

    if (req.auth.user.roles.includes("ROLE_COORDINATEUR")) {
      return Response.redirect(urlCoordinateur);
    }

    if (req.auth.user.roles.includes("ROLE_APPRENANT")) {
      return Response.redirect(urlApprenant);
    }
  }

  // ✅ Protect /coordinateur routes: if not authenticated, redirect to /login
  if (pathname.startsWith("/coordinateur") && !req.auth) {
    const loginUrl = new URL("/login", origin);
    return Response.redirect(loginUrl);
  }

  // You can add similar protection for /apprenant if needed
});

export const config = {
    matcher: ['/home/:path*','/login/:path*','/coordinateur/:path*', '/apprenant/:path*']
};