// Desc: Common methods used in the application

// Get the value of a field by name
export const getFieldValueByName = (section, fieldName) => {
    if (section === null || section.fields === null) {
        return null;
    }

    const field = section.fields.find((field) => field.name === fieldName);
    return field ? field.value ?? null : null;
};

// helper function to get field status by name
export const getFieldStatusByName = (section, fieldName) => {
    if (section === null || section.fields === null) {
        return true;
    }

    const field = section.fields.find((field) => field.name === fieldName);
    return field ? field.status ?? null : true;
};

// Get the section by name
export const getSectionByName = (page, sectionName) => {
    if (page === null || page.sections === null) {
        return null;
    }

    return page.sections.find((section) => section.name === sectionName) ?? null;
};

// helper function to get section status by name
export const getSectionStatusByName = (page, sectionName) => {
    if (page === null || page.sections === null) {
        return true;
    }

    const section = page.sections.find((section) => section.name === sectionName);
    return section ? section.status ?? null : true;
};

// Helper function to get a field file by name
export const getFieldFileByName = (section, fieldName) => {
    if (section === null || section.fields === null) {
        return null;
    }

    const field = section.fields.find((field) => field.name === fieldName);
    if (!field || !field.files[0]) {
        return null;
    }

    return field.files[0].file_path ?? null;
};


// Helper function to get multiple field files by name
export const getMultipleFieldFilesByName = (section, fieldName) => {
    if (section === null || section.fields === null) {
      return null;
    }
  
    const field = section.fields.find((field) => field.name === fieldName);
    return field && field.files.length > 0 ? field.files : null;
  };
  
