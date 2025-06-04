// export { auth as middleware } from "@/auth"
import { auth } from "@/auth"
 
export default auth((req) => {
  if (!req.auth && req.nextUrl.pathname !== "/login") {
    const newUrl = new URL("/login", req.nextUrl.origin)
    return Response.redirect(newUrl)
  }
  if(req.auth && (req.nextUrl.pathname == "/login" || req.nextUrl.pathname == "/home")){
    const urlCoordinateur = new URL("/coordinateur", req.nextUrl.origin)
    const urlApprenant = new URL("/apprenant", req.nextUrl.origin)
    if(req.auth?.user.roles.includes("ROLE_COORDINATEUR")) {
        return Response.redirect(urlCoordinateur)
    }
    if(req.auth?.user.roles.includes("ROLE_APPRENANT")){
        return Response.redirect(urlApprenant)
    }
  }
})
export const config = {
    matcher: ['/home','/login/:path*','/coordinateur/:path*', '/apprenant/:path*']
};