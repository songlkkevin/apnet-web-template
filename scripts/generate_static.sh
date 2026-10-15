#!/usr/bin/env bash
set -euo pipefail

# Usage: ./scripts/generate_static.sh [--source web] [--output static_site]
# Renders PHP directly; no local server, crawler, or network access is needed.
ROOT_DIR="$(cd "$(dirname "$0")/.." && pwd)"
exec python3 "$ROOT_DIR/scripts/build_site.py" "$@"
