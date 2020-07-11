const {
  src,
  dest,
  parallel,
  series
} = require("gulp")


// Requires
const del = require("del")

// --- Gulp
const watch = require("gulp-watch")

const CachePath = "../../../cache/"
const ComponentsPath = "Components/"
const LayoutsPath = "Layouts/"
const RequiresPath = "Requires/"
const AdminPath = "Admin/"

const RequiredFiles = CachePath + "RequiredFilesCache.php"
const ClassesConfigable = CachePath + "ClassesConfigableCache.php"

const Globs = {
  RequiredFiles: [
    AdminPath + "{**/*Hook,Admin}.php",
    "ProjectConstants.php",
    "ThemeSetup.php",
    ComponentsPath + "**/*{Definition,Hook,Metabox,Config}.php",
    LayoutsPath + "**/*{Definition,Hook,Metabox,Config}.php",
    RequiresPath + "**/*.php",
  ],
  ClassesConfigable: [
    ComponentsPath + "**/*Config.php",
    LayoutsPath + "**/*Config.php",
  ],
}


function deleteReqiredFiles() {
  return del(RequiredFiles, {
    force: true
  })
}
exports.deleteReqiredFiles = deleteReqiredFiles

function deleteClassesConfigable() {
  return del(ClassesConfigable, {
    force: true
  })
}
exports.deleteClassesConfigable = deleteClassesConfigable


function watchFiles() {

  const Actions = ["unlink", "add"]

  for (const action of Actions) {
    watch(Globs.RequiredFiles).on(action, function (file) {
      deleteReqiredFiles()
      console.log("Require: " + file)
    })

    watch(Globs.ClassesConfigable).on(action, function (file) {
      deleteClassesConfigable()
      console.log("Config: " + file)
    })
  }


}
exports.watchFiles = watchFiles


const clean = parallel(deleteReqiredFiles, deleteClassesConfigable)
exports.clean = clean

exports.default = series(clean, watchFiles)
