import { Calendar, ChevronUp, Home, Inbox, PersonStanding, Search, Settings, User2, MessageSquare } from "lucide-react"

import {
  Sidebar,
  SidebarContent,
  SidebarFooter,
  SidebarGroup,
  SidebarGroupContent,
  SidebarGroupLabel,
  SidebarMenu,
  SidebarMenuButton,
  SidebarMenuItem,
} from "@/components/ui/sidebar"
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuTrigger } from "./ui/dropdown-menu"
import { handleSignOut } from '@/actions/auth/login'
import { auth } from "@/auth"


// Menu items.
const items = [
  {
    title: "Home",
    url: "/coordinateur",
    icon: Home,
  },
  {
    title: "Account",
    url: "/coordinateur/account",
    icon: PersonStanding,
  },
  {
    title: "Calendar",
    url: "#",
    icon: Calendar,
  },
  {
    title: "Chat",
    url: "#",
    icon: MessageSquare,
  },
  {
    title: "Settings",
    url: "#",
    icon: Settings,
  },
]

export async function AppSidebar() {
  const session = await auth()
  if(session?.user.roles.includes("ROLE_COORDINATEUR")){
    return (
      <Sidebar>
        <SidebarContent>
          <SidebarGroup >
            <SidebarGroupLabel>BROWSE</SidebarGroupLabel>
            <SidebarGroupContent >
              <SidebarMenu>
                {items.map((item) => (
                  <SidebarMenuItem key={item.title}>
                    <SidebarMenuButton asChild>
                      <a href={item.url}>
                        <item.icon />
                        <span>{item.title}</span>
                      </a>
                    </SidebarMenuButton>
                  </SidebarMenuItem>
                ))}
              </SidebarMenu>
            </SidebarGroupContent>
          </SidebarGroup>   
        </SidebarContent>
        <SidebarFooter>
            <SidebarMenu>
              <SidebarMenuItem>
                <DropdownMenu>
                  <DropdownMenuTrigger asChild>
                    <SidebarMenuButton>
                      <User2 /> {session.user.nom} {session.user.prenom}
                      <ChevronUp className="ml-auto" />
                    </SidebarMenuButton>
                  </DropdownMenuTrigger>
                  <DropdownMenuContent
                    side="top"
                    className="w-[--radix-popper-anchor-width]"
                  >
                    <DropdownMenuItem className="hover:cursor-pointer focus:text-white focus:bg-violet-600 transition">
                      <span>Account</span>
                    </DropdownMenuItem>
                    <DropdownMenuItem className="hover:cursor-pointer focus:text-white focus:bg-violet-600 transition">
                      <span>Billing</span>
                    </DropdownMenuItem>
                    
                      <form action={handleSignOut}>
                          <button type="submit">
                            <DropdownMenuItem className="w-[120px] focus:bg-red-500 focus:text-white cursor-pointer transition">
                              Sign Out
                            </DropdownMenuItem>
                          </button>
                      </form>
                    
                  </DropdownMenuContent>
                </DropdownMenu>
              </SidebarMenuItem>
            </SidebarMenu>
          </SidebarFooter>
      </Sidebar>
    )
  }
}