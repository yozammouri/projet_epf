import NextAuth, { AuthValidity, BackendJWT, Payload, User, UserObject } from "next-auth"
import { loginSchema } from "./lib/definitions";
import Credentials from "next-auth/providers/credentials"
import { BASE_URL } from "./lib/constants";
import { jwtDecode } from 'jwt-decode';
import { JWT } from "next-auth/jwt";


 
export const { handlers, signIn, signOut, auth } = NextAuth({
  providers: [
    Credentials({
      credentials: {
        // email: { label: "email", type: "text" },
        // password: { label: "password", type: "password" }
      },
      async authorize(credentials) {
        const parsed = loginSchema.safeParse(credentials)
        if (!parsed.success) {
          throw new Error("Invalid email or password format");
        }

        try{
          const res = await fetch(`${BASE_URL}/auth`, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(parsed.data)
          });

          const tokens : BackendJWT = await res.json();
          if (!res.ok) throw tokens;
            
            // console.log("Access Token: ", tokens.token);
            // console.log("Refresh Token: ", tokens.refreshToken);

            const accessPayload: Payload = jwtDecode(tokens.token);
            const refresh_expiration: number = tokens.refresh_token_expiration

            const user : UserObject = {
              ip: accessPayload.ip,
              username: accessPayload.username,
              roles: accessPayload.roles,
              nom: accessPayload.nom,
              prenom: accessPayload.prenom
            }

            // Extract the auth validity from the tokens
            const validity: AuthValidity = {
              valid_until: accessPayload.exp,
              refresh_until: refresh_expiration      
            };
            // Return the object that next-auth calls 'User' (which we've defined in next-auth.d.ts)
            return {
              // id: refresh.jti, // User object is forced to have a string id so use refresh token id
              tokens: tokens,
              user: user,
              validity: validity
            } as User;
            
        }catch (error) {
            console.error(error);
            return null;
          }
      }
    })
  ],
  session: {
    strategy: "jwt"
  },
  callbacks: {
    // The returned value of this callback will be encrypted, and it is stored in a cookie.
    async jwt({ token, user}) { // token is NEXTAUTH token 
      // console.log("This is the object /token/ : ",token)
      // const RT: string = token.data.tokens.refreshToken as string;

    // On sign-in: user contains data from backend (e.g., the JWT token)
        if (user) {
          console.debug("Initial signin");
          return { ...token, data: user };
          
        }

        if(Date.now() < token.data.validity.valid_until*1000){
          console.log("Access Token is still valid");
          return token;
        }

        if(Date.now() < token.data.validity.refresh_until*1000){
          // console.log("MEMEMEMEMEME",token.data.tokens.refreshToken);
          // console.log("Access token is being refreshed => Sending another one")
          try {
            // console.log("the initial refresh token : ",token.data.tokens.refreshToken);
            // console.log(typeof(token.data.tokens.refreshToken))
            const res = await fetch(`${BASE_URL}/api/token/refresh`, {
              method: "POST",
              headers: { "Content-Type": "application/json" },
              body: JSON.stringify({ refreshToken : token.data.tokens.refreshToken }),
            });

            const refreshedTokens: BackendJWT= await res.json();
            // console.log(typeof(refreshedTokens))
            console.log("refreshedTokens : ",refreshedTokens)
            const refreshedTokensPayload: Payload = jwtDecode(refreshedTokens.token);
            // console.log("refreshedTokensPayload : ",refreshedTokensPayload)
            
            if (!res.ok) throw refreshedTokens

            // console.log("refreshedTokens : ",refreshedTokens)

            
            console.log("Token refreshed!!!")
            return {
              ...token,
              data: {
                tokens: {
                  accessToken: refreshedTokens.token,
                  refreshToken: refreshedTokens.refreshToken,
                  refresh_token_expiration: refreshedTokens.refresh_token_expiration
                },
                user: {
                  ip: refreshedTokensPayload.ip,
                  username: refreshedTokensPayload.username,
                  roles: refreshedTokensPayload.roles,
                  nom: refreshedTokensPayload.nom,
                  prenom: refreshedTokensPayload.prenom,
                },
                validity: {
                  valid_until: refreshedTokensPayload.exp, // expiration du token en secondes
                  refresh_until: refreshedTokens.refresh_token_expiration, // déjà en secondes
                },
              },
            };
          } catch (err) {
            console.error("Token refresh failed", err);
          } 
        }

        return { ...token, error: "RefreshTokenExpired" } as JWT;

    },
    async session({ session, token}) {
      session.user = token.data.user;
      session.token = token.data.tokens.token
      session.validity = token.data.validity;
      session.error = token.error;
      console.log("session Created for ",session.user.nom,"",session.user.prenom);
      return session;
    },
  },
  
    pages: {
      signIn : "/login"
    }
})