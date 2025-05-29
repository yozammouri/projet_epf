import NextAuth from "next-auth";


declare module "next-auth" {

  export interface UserObject {
    ip: string,
    username: string,
    roles: string[],
    nom: string,
    prenom: string
  }

  export interface BackendJWT{
    token: string,
    refreshToken: string
    refresh_token_expiration: number
  }

  export interface Payload extends UserObject{  //decoded jwt
    jti: string, 
    iat: number,
    exp: number,
  }

  export interface AuthValidity {
    valid_until: number;
    refresh_until: number;
  }

  export interface User {
    tokens: BackendJWT,
    user: UserObject,
    validity: AuthValidity
  }

  export interface Session {
    user: UserObject;
    token: string
    validity: AuthValidity;
    error: "RefreshTokenExpired" | "RefreshAccessTokenError";
  }
}

declare module "next-auth/jwt" {
  /**
   * Returned by the `jwt` callback and `getToken`, when using JWT sessions
   */
  export interface JWT {
    data: User;
    error: "RefreshTokenExpired" | "RefreshAccessTokenError";
  }
}
