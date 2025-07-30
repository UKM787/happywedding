/**
 * Image helper functions for Vue components
 */

/**
 * Get the correct image URL based on the path
 * @param {string} path - The image path
 * @param {string} defaultImage - The default image to use if path is invalid
 * @returns {string} - The correct image URL
 */
export function getImageUrl(path, defaultImage = '/assets/savedate/savedateupload.png') {
    // If path is empty or null, return default image
    if (!path) {
        return defaultImage;
    }
    
    // For debugging
    console.log('Original image path:', path);
    
    // Normalize path
    let normalizedPath = path;
    
    // Remove leading backslash if present
    if (normalizedPath.startsWith('\\')) {
        normalizedPath = normalizedPath.substring(1);
    }
    
    // Convert all backslashes to forward slashes
    normalizedPath = normalizedPath.replace(/\\/g, '/');
    
    // Remove leading slash
    normalizedPath = normalizedPath.replace(/^\/+/, '');
    
    console.log('Normalized path:', normalizedPath);
    
    // Check if path is already a full URL
    if (normalizedPath.startsWith('http://') || normalizedPath.startsWith('https://')) {
        return normalizedPath;
    }
    
    // Check if path starts with 'assets/'
    if (normalizedPath.startsWith('assets/')) {
        return '/' + normalizedPath;
    }
    
    // Check if path starts with 'storage/'
    if (normalizedPath.startsWith('storage/')) {
        return '/' + normalizedPath;
    }
    
    // Check if path starts with 'uploads/' (case insensitive)
    if (normalizedPath.toLowerCase().startsWith('uploads/')) {
        return '/' + normalizedPath;
    }
    
    // Default: add storage prefix
    return '/storage/' + normalizedPath;
}

/**
 * Handle image loading errors
 * @param {Event} event - The error event
 * @param {string} defaultImage - The default image to use
 */
export function handleImageError(event, defaultImage = '/assets/savedate/savedateupload.png') {
    console.error('Image failed to load:', event.target.src);
    
    // Get original path that failed
    const originalSrc = event.target.src;
    
    // Try alternative paths
    const alternatives = [];
    
    // 1. If we tried with /storage/ prefix, try without it
    if (originalSrc.includes('/storage/')) {
        alternatives.push(originalSrc.replace('/storage/', '/'));
    } else {
        // 2. If we tried without /storage/ prefix, try with it
        const pathParts = originalSrc.split('/');
        if (pathParts.length > 1) {
            pathParts.splice(1, 0, 'storage');
            alternatives.push(pathParts.join('/'));
        }
    }
    
    // 3. Try with assets prefix
    if (!originalSrc.includes('/assets/')) {
        const filename = originalSrc.split('/').pop();
        if (filename) {
            alternatives.push(`/assets/${filename}`);
        }
    }
    
    console.log('Trying alternatives:', alternatives);

    // Try each alternative
    tryNextAlternative(alternatives, 0, event, defaultImage);
}

/**
 * Try loading alternatives one by one
 * @param {Array} alternatives - List of alternative paths to try
 * @param {number} index - Current index in the alternatives array
 * @param {Event} event - The original error event
 * @param {string} defaultImage - Default image to use if all alternatives fail
 */
function tryNextAlternative(alternatives, index, event, defaultImage) {
    // If we've tried all alternatives, use the default image
    if (index >= alternatives.length) {
        console.log('All alternatives failed, using default image');
        event.target.src = defaultImage;
        return;
    }
    
    const alternative = alternatives[index];
    console.log(`Trying alternative ${index + 1}/${alternatives.length}:`, alternative);
    
    const img = new Image();
    img.onload = () => {
        console.log('Alternative worked:', alternative);
        event.target.src = alternative;
    };
    img.onerror = () => {
        console.log('Alternative failed:', alternative);
        // Try the next alternative
        tryNextAlternative(alternatives, index + 1, event, defaultImage);
    };
    img.src = alternative;
}

