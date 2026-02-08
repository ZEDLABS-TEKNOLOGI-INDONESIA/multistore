#!/bin/bash

# Script untuk generate blueprint Frontend.md dan Backend.md
# Usage: ./generate.sh

set -e

# Warna untuk output
RED='\033[0;31m'
GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

echo -e "${BLUE}Starting blueprint generation...${NC}"

# Definisi folder dan file yang dikecualikan
EXCLUDE_DIRS=(
    ".git"
    "node_modules"
    "vendor"
    "public"
    "storage"
    ".idea"
    ".vscode"
    "bootstrap/cache"
    "dist"
    "build"
)

EXCLUDE_FILES=(
    "*.lock"
    "*.log"
    "*.cache"
    "*.map"
    "*.min.js"
    "*.min.css"
    ".DS_Store"
    "*.jpg"
    "*.jpeg"
    "*.png"
    "*.gif"
    "*.svg"
    "*.ico"
    "*.woff"
    "*.woff2"
    "*.ttf"
    "*.eot"
    "*.pdf"
    "*.zip"
    "*.tar"
    "*.gz"
    "*.webp"
    "*.mp4"
    "*.mp3"
    "*.avi"
)

# Fungsi untuk mengecek apakah file adalah binary
is_binary() {
    # Gunakan file command dengan fallback
    if command -v file &> /dev/null; then
        if file -b "$1" 2>/dev/null | grep -qiE "text|empty|json|xml"; then
            return 1
        else
            return 0
        fi
    else
        # Fallback: cek ekstensi file
        local ext="${1##*.}"
        case "$ext" in
            php|js|jsx|ts|tsx|css|scss|html|json|md|sql|sh|yml|yaml|xml|txt|env|gitignore)
                return 1
                ;;
            *)
                return 0
                ;;
        esac
    fi
}

# Fungsi untuk mengecek apakah path harus dikecualikan
should_exclude() {
    local path="$1"
    
    # Cek exclude directories
    for exclude_dir in "${EXCLUDE_DIRS[@]}"; do
        if [[ "$path" == *"/$exclude_dir/"* ]] || [[ "$path" == *"/$exclude_dir" ]] || [[ "$path" == "$exclude_dir/"* ]]; then
            return 0
        fi
    done
    
    # Cek exclude files pattern
    for exclude_pattern in "${EXCLUDE_FILES[@]}"; do
        if [[ "$path" == $exclude_pattern ]]; then
            return 0
        fi
        # Cek juga dengan basename
        if [[ "$(basename "$path")" == $exclude_pattern ]]; then
            return 0
        fi
    done
    
    return 1
}

# Fungsi untuk menentukan ekstensi file untuk syntax highlighting
get_language() {
    local file="$1"
    local filename="$(basename "$file")"
    
    # Cek blade.php terlebih dahulu
    if [[ "$filename" == *.blade.php ]]; then
        echo "blade"
        return
    fi
    
    local ext="${filename##*.}"
    
    case "$ext" in
        php) echo "php" ;;
        js) echo "javascript" ;;
        jsx) echo "jsx" ;;
        ts) echo "typescript" ;;
        tsx) echo "tsx" ;;
        css) echo "css" ;;
        scss) echo "scss" ;;
        sass) echo "sass" ;;
        html) echo "html" ;;
        json) echo "json" ;;
        md) echo "markdown" ;;
        sql) echo "sql" ;;
        sh) echo "bash" ;;
        yml|yaml) echo "yaml" ;;
        xml) echo "xml" ;;
        env) echo "bash" ;;
        *) echo "text" ;;
    esac
}

# Fungsi untuk mendapatkan ukuran file (cross-platform)
get_file_size() {
    local file="$1"
    if [[ "$OSTYPE" == "darwin"* ]]; then
        # macOS
        stat -f%z "$file" 2>/dev/null || echo 0
    else
        # Linux
        stat -c%s "$file" 2>/dev/null || echo 0
    fi
}

# Fungsi untuk menulis konten file ke markdown
write_file_content() {
    local file="$1"
    local output_file="$2"
    local relative_path="${file#./}"
    
    # Skip jika file harus dikecualikan
    if should_exclude "$relative_path"; then
        return
    fi
    
    # Skip jika file tidak ada
    if [ ! -f "$file" ]; then
        return
    fi
    
    # Skip jika file binary
    if is_binary "$file"; then
        echo -e "${YELLOW}Skipping binary file: $relative_path${NC}"
        return
    fi
    
    # Skip jika file terlalu besar (> 1MB)
    local file_size=$(get_file_size "$file")
    if [ "$file_size" -gt 1048576 ]; then
        echo -e "${YELLOW}Skipping large file ($(($file_size / 1024))KB): $relative_path${NC}"
        return
    fi
    
    local lang=$(get_language "$file")
    
    echo "" >> "$output_file"
    echo "---" >> "$output_file"
    echo "" >> "$output_file"
    echo "**File:** \`./$relative_path\`" >> "$output_file"
    echo "" >> "$output_file"
    echo "\`\`\`$lang" >> "$output_file"
    cat "$file" >> "$output_file"
    echo "" >> "$output_file"
    echo "\`\`\`" >> "$output_file"
    echo "" >> "$output_file"
    
    echo -e "${GREEN}✓${NC} $relative_path"
}

# Generate Frontend.md
generate_frontend() {
    local output="Frontend.md"
    echo -e "${BLUE}Generating $output...${NC}"
    
    # Header
    cat > "$output" << EOF
# Frontend Blueprint

Dokumentasi lengkap file-file frontend dari project ini.

**Generated at:** $(date '+%Y-%m-%d %H:%M:%S')

## Struktur Frontend

EOF
    
    # Resources (views, js, css)
    if [ -d "resources/views" ]; then
        echo "### Views (Blade Templates)" >> "$output"
        echo "" >> "$output"
        find resources/views -type f -name "*.blade.php" 2>/dev/null | sort | while read file; do
            write_file_content "$file" "$output"
        done
    fi
    
    if [ -d "resources/js" ]; then
        echo "### JavaScript Files" >> "$output"
        echo "" >> "$output"
        find resources/js -type f \( -name "*.js" -o -name "*.jsx" -o -name "*.ts" -o -name "*.tsx" -o -name "*.vue" \) 2>/dev/null | sort | while read file; do
            write_file_content "$file" "$output"
        done
    fi
    
    if [ -d "resources/css" ]; then
        echo "### CSS Files" >> "$output"
        echo "" >> "$output"
        find resources/css -type f \( -name "*.css" -o -name "*.scss" -o -name "*.sass" \) 2>/dev/null | sort | while read file; do
            write_file_content "$file" "$output"
        done
    fi
    
    # Livewire Components views
    if [ -d "resources/views/livewire" ]; then
        echo "### Livewire Component Views" >> "$output"
        echo "" >> "$output"
        find resources/views/livewire -type f -name "*.blade.php" 2>/dev/null | sort | while read file; do
            write_file_content "$file" "$output"
        done
    fi
    
    # Config files untuk frontend
    echo "### Configuration Files" >> "$output"
    echo "" >> "$output"
    for file in package.json tailwind.config.js postcss.config.js vite.config.js webpack.mix.js tsconfig.json .eslintrc.js .prettierrc; do
        if [ -f "$file" ]; then
            write_file_content "$file" "$output"
        fi
    done
    
    echo -e "${GREEN}✅ $output generated successfully!${NC}"
}

# Generate Backend.md
generate_backend() {
    local output="Backend.md"
    echo -e "${BLUE}Generating $output...${NC}"
    
    # Header
    cat > "$output" << EOF
# Backend Blueprint

Dokumentasi lengkap file-file backend dari project ini.

**Generated at:** $(date '+%Y-%m-%d %H:%M:%S')

## Struktur Backend

EOF
    
    # App directory
    if [ -d "app/Http/Controllers" ]; then
        echo "### Controllers" >> "$output"
        echo "" >> "$output"
        find app/Http/Controllers -type f -name "*.php" 2>/dev/null | sort | while read file; do
            write_file_content "$file" "$output"
        done
    fi
    
    if [ -d "app/Models" ]; then
        echo "### Models" >> "$output"
        echo "" >> "$output"
        find app/Models -type f -name "*.php" 2>/dev/null | sort | while read file; do
            write_file_content "$file" "$output"
        done
    fi
    
    if [ -d "app/Http/Middleware" ]; then
        echo "### Middleware" >> "$output"
        echo "" >> "$output"
        find app/Http/Middleware -type f -name "*.php" 2>/dev/null | sort | while read file; do
            write_file_content "$file" "$output"
        done
    fi
    
    if [ -d "app/Http/Requests" ]; then
        echo "### Form Requests" >> "$output"
        echo "" >> "$output"
        find app/Http/Requests -type f -name "*.php" 2>/dev/null | sort | while read file; do
            write_file_content "$file" "$output"
        done
    fi
    
    if [ -d "app/Providers" ]; then
        echo "### Service Providers" >> "$output"
        echo "" >> "$output"
        find app/Providers -type f -name "*.php" 2>/dev/null | sort | while read file; do
            write_file_content "$file" "$output"
        done
    fi
    
    if [ -d "app/Livewire" ] || [ -d "app/Http/Livewire" ]; then
        echo "### Livewire Components (Logic)" >> "$output"
        echo "" >> "$output"
        find app/Livewire app/Http/Livewire -type f -name "*.php" 2>/dev/null | sort | while read file; do
            write_file_content "$file" "$output"
        done
    fi
    
    # Services, Helpers, etc
    echo "### Other App Files" >> "$output"
    echo "" >> "$output"
    find app -type f -name "*.php" \
        ! -path "*/Http/Controllers/*" \
        ! -path "*/Models/*" \
        ! -path "*/Http/Middleware/*" \
        ! -path "*/Http/Requests/*" \
        ! -path "*/Providers/*" \
        ! -path "*/Livewire/*" \
        ! -path "*/Http/Livewire/*" \
        2>/dev/null | sort | while read file; do
        write_file_content "$file" "$output"
    done
    
    # Routes
    if [ -d "routes" ]; then
        echo "### Routes" >> "$output"
        echo "" >> "$output"
        find routes -type f -name "*.php" 2>/dev/null | sort | while read file; do
            write_file_content "$file" "$output"
        done
    fi
    
    # Database
    if [ -d "database/migrations" ]; then
        echo "### Migrations" >> "$output"
        echo "" >> "$output"
        find database/migrations -type f -name "*.php" 2>/dev/null | sort | while read file; do
            write_file_content "$file" "$output"
        done
    fi
    
    if [ -d "database/seeders" ]; then
        echo "### Seeders" >> "$output"
        echo "" >> "$output"
        find database/seeders -type f -name "*.php" 2>/dev/null | sort | while read file; do
            write_file_content "$file" "$output"
        done
    fi
    
    if [ -d "database/factories" ]; then
        echo "### Factories" >> "$output"
        echo "" >> "$output"
        find database/factories -type f -name "*.php" 2>/dev/null | sort | while read file; do
            write_file_content "$file" "$output"
        done
    fi
    
    # Config
    if [ -d "config" ]; then
        echo "### Configuration Files" >> "$output"
        echo "" >> "$output"
        find config -type f -name "*.php" 2>/dev/null | sort | while read file; do
            write_file_content "$file" "$output"
        done
    fi
    
    # Root config files
    echo "### Root Configuration" >> "$output"
    echo "" >> "$output"
    for file in composer.json phpunit.xml artisan .env.example; do
        if [ -f "$file" ]; then
            write_file_content "$file" "$output"
        fi
    done
    
    echo -e "${GREEN}✅ $output generated successfully!${NC}"
}

# Main execution
main() {
    # Pastikan script dijalankan dari root directory project
    if [ ! -f "artisan" ]; then
        echo -e "${RED}Error: Script harus dijalankan dari root directory Laravel project${NC}"
        exit 1
    fi
    
    echo -e "${BLUE}Project Root: $(pwd)${NC}"
    echo ""
    
    # Generate blueprints
    generate_frontend
    echo ""
    generate_backend
    
    echo ""
    echo -e "${BLUE}═══════════════════════════════════════${NC}"
    echo -e "${GREEN}✅ Blueprint generation completed!${NC}"
    echo -e "${BLUE}═══════════════════════════════════════${NC}"
    echo ""
    echo -e "Files created:"
    echo -e "  ${GREEN}✓${NC} Frontend.md"
    echo -e "  ${GREEN}✓${NC} Backend.md"
    echo ""
}

# Run main function
main "$@"