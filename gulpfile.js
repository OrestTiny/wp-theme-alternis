const gulp = require("gulp"),
  strip = require("gulp-strip-comments"),
  babel = require("gulp-babel"),
  // sourcemaps = require("gulp-sourcemaps"),  if u need
  sass = require("gulp-sass")(require("sass")),
  autoprefixer = require("gulp-autoprefixer"),
  size = require("gulp-size"),
  notify = require("gulp-notify"),
  uglify = require("gulp-uglify"), // minify file
  rename = require("gulp-rename"),
  cleanCSS = require("gulp-clean-css"), // remove all comments
  plumber = require("gulp-plumber"),
  postCSS = require("gulp-postcss"),
  mqpacker = require("css-mqpacker"),
  sortCSSmq = require("sort-css-media-queries"),
  debug = require("gulp-debug");

gulp.task("scripts", function () {
  return gulp
    .src([
      "./themes/alternis/assets/js/*.js",
      "!./themes/alternis/assets/js/*.min.js",
    ])
    .pipe(
      babel({
        presets: ["@babel/env"],
      })
    )
    .pipe(uglify())
    .pipe(rename({ suffix: ".min" }))
    .pipe(strip())
    .pipe(gulp.dest("./themes/alternis/assets/js"))
    .pipe(size());
});

gulp.task("widgets-scripts", function () {
  return gulp
    .src([
      "./themes/alternis/widgets/**/*.js",
      "!./themes/alternis/widgets/**/*.min.js",
    ])

    .pipe(
      babel({
        presets: ["@babel/env"],
      })
    )
    .pipe(uglify())
    .pipe(rename({ suffix: ".min" }))
    .pipe(strip())
    .pipe(gulp.dest("./themes/alternis/widgets/"))
    .pipe(size());
});

gulp.task("sass", function () {
  return (
    gulp
      .src(["./themes/alternis/assets/css/**/*.scss"])
      .pipe(debug({ title: "File:" }))
      // .pipe(sourcemaps.init({ largeFile: true }))
      .pipe(plumber())
      .pipe(
        sass({
          outputStyle: "compressed",
          includePaths: ["node_modules"],
        }).on("error", function (err) {
          this.emit("end");
          return notify().write(err);
        })
      )
      .pipe(autoprefixer("last 2 version", "> 2%", "ie 6", "ie 5"))
      .pipe(
        postCSS([
          mqpacker({
            sort: sortCSSmq.desktopFirst,
          }),
        ])
      )
      .pipe(
        cleanCSS({ level: { 1: { specialComments: 0 } }, compatibility: "ie8" })
      )
      // .pipe(sourcemaps.write("."))
      .pipe(gulp.dest("./themes/alternis/assets/css"))
      .pipe(size())
  );
});

gulp.task("sass-widget", function () {
  return gulp
    .src("./themes/alternis/widgets/**/*.scss")
    .pipe(debug({ title: "File:" }))
    .pipe(plumber())
    .pipe(
      sass({
        outputStyle: "expanded",
        includePaths: ["node_modules"],
      }).on("error", function (err) {
        this.emit("end");
        return notify().write(err);
      })
    )
    .pipe(
      autoprefixer({
        browserslistrc: ["> 1%', 'last 3 versions"],
        cascade: true,
      })
    )
    .pipe(
      postCSS([
        mqpacker({
          sort: sortCSSmq.desktopFirst,
        }),
      ])
    )
    .pipe(
      cleanCSS({ level: { 1: { specialComments: 0 } }, compatibility: "ie8" })
    )
    .pipe(gulp.dest("./themes/alternis/widgets"))
    .pipe(size());
});

//watcher
gulp.task("watch", function () {
  gulp.watch(
    [
      "./themes/alternis/assets/css/*.scss",
      "./themes/alternis/assets/css/**/*.scss",
    ],
    gulp.series("sass")
  );
  gulp.watch("./themes/alternis/widgets/**/*.scss", gulp.series("sass-widget"));
  gulp.watch(
    [
      "./themes/alternis/assets/js/**/*.js",
      "!./themes/alternis/assets/js/**/*.min.js",
    ],
    gulp.series("scripts")
  );
  gulp.watch(
    [
      "./themes/alternis/widgets/**/*.js",
      "!./themes/alternis/widgets/**/*.min.js",
    ],
    gulp.series("widgets-scripts")
  );
});

gulp.task("default", gulp.series("watch"));
