import { CreditCard, FileText, School } from "lucide-react"
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from "@/components/ui/card"
import { Button } from "@/components/ui/button"

interface ProductCardProps {
  title: string
  description: string
  icon: string
  image?: string
}

export default function ProductCard({ title, description, icon, image = '' }: ProductCardProps) {
  const getIcon = () => {
    switch (icon) {
      case "credit-card":
        return <CreditCard className="h-10 w-10 text-[#3EBA9E]" />
      case "file-text":
        return <FileText className="h-10 w-10 text-[#3EBA9E]" />
      case "school":
        return <School className="h-10 w-10 text-[#3EBA9E]" />
      default:
        return <CreditCard className="h-10 w-10 text-[#3EBA9E]" />
    }
  }

  return (
    <Card className="flex flex-col h-full transition-all duration-500 hover:shadow-lg hover:border-[#3EBA9E]/50 group">
      <CardHeader>
        {image && (
          <div className="relative h-48 w-full overflow-hidden">
            <img src={image} alt={title} className="object-cover" />
          </div>
        )}
        <div className="mb-2 transition-transform duration-500 transform group-hover:scale-110 group-hover:rotate-3">
          {getIcon()}
        </div>
        <CardTitle className="text-[#00664E] transition-colors duration-300">{title}</CardTitle>
        <CardDescription>{description}</CardDescription>
      </CardHeader>
      <CardContent className="flex-1">
        <p className="text-sm text-gray-500">
          Streamline your operations and enhance efficiency with our powerful software solution.
        </p>
      </CardContent>
      <CardFooter>
        <Button
          variant="outline"
          className="w-full border-[#00664E] text-[#00664E] hover:bg-[#00664E]/10 relative overflow-hidden group"
        >
          <span className="relative z-10">Learn more</span>
          <span className="absolute inset-0 bg-[#3EBA9E]/10 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300"></span>
        </Button>
      </CardFooter>
    </Card>
  )
}
